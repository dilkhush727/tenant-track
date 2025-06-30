<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MessageModel;
use App\Models\UserModel;

class MessagesController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        $messageModel = new MessageModel();

        // Fetch all users except self
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $users = $builder->where('id !=', $userId)->get()->getResultArray();

        // Add unseen message count per user
        foreach ($users as &$user) {
            $user['unseen_count'] = $messageModel
                ->where('sender_id', $user['id'])
                ->where('receiver_id', $userId)
                ->where('is_read', 0)
                ->countAllResults();
        }

        return view('messages/chat', ['users' => $users]);
    }

    public function send()
    {
        $senderId = session()->get('user_id');
        $receiverId = $this->request->getPost('receiver_id');
        $body = $this->request->getPost('body');

        $messageModel = new MessageModel();

        $messageModel->save([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'body' => $body,
            'message_type' => 'text',
            'is_read' => 0,
        ]);

        return $this->response->setJSON(['success' => true]);
    }

    public function thread($userId)
    {
        $sessionId = session()->get('user_id');
        $messageModel = new MessageModel();

        // Mark as read
        $messageModel
            ->where('sender_id', $userId)
            ->where('receiver_id', $sessionId)
            ->where('is_read', 0)
            ->set(['is_read' => 1])
            ->update();

        // Fetch messages
        $messages = $messageModel
            ->where("(sender_id = $sessionId AND receiver_id = $userId) OR (sender_id = $userId AND receiver_id = $sessionId)")
            ->orderBy('created_at', 'ASC')
            ->findAll();

        return view('messages/thread', ['messages' => $messages]);
    }

}
