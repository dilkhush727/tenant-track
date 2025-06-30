<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .unseen-dot {
        color: red;
        font-size: 0.75em;
        font-weight: bold;
        margin-left: 8px;
    }

    .msg-head {
        display: none;
        align-items: center;
        gap: 10px;
    }

    #chatUserImage {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>

<style>
    .container-xl{
        padding: 0 !important;
        margin: 0 !important;
    }
    .msg-main{
        position: relative;
        background-color: #fff;
        border-radius: 0.3rem;
        height: calc(100vh - 7rem);
        overflow: hidden;
        /* min-height: calc(100% - 1rem); */
        /* background: #fff; */
        /* display: flex; */
        margin: 20px;
    }
    .msg-left{
        /* border-right: 1px solid #ccc; */
        outline: 0;
        height: 100%;
        overflow: hidden;
        width: 300px;
        float: left;
        padding: 15px;
    }
    .msg-right{
        width: auto;
        overflow: hidden;
        height: 100%;
        border-left: 1px solid #ccc;
    }
    .msg-head {
        padding: 15px;
        border-bottom: 1px solid #ccc;
    }
    #userList img{
        width: 40px;
    }
    .chat-link h3{
        color: #222;
        font-size: 16px;
        font-weight: 500;
        line-height: 1.5;
        text-transform: capitalize;
        margin-bottom: 0;
    }
    .chat-link p {
        color: #343434;
        font-size: 13px;
        font-weight: 400;
        line-height: 1.5;
        text-transform: capitalize;
        margin-bottom: 0;
    }
    .msg-head h3 {
        color: #222;
        font-size: 18px;
        font-weight: 600;
        line-height: 1.5;
        margin-bottom: 0;
    }
    .msg-head p {
        color: #343434;
        font-size: 13px;
        font-weight: 400;
        line-height: 1.5;
        text-transform: capitalize;
        margin-bottom: 0;
    }
    .chat-icon {
        display: none;
        font-size: 20px;
        margin-right: 15px;
    }
    @media (max-width: 767px) {
        .chat-icon {
            display: block;
            margin-right: 5px;
        }
    }
    .send-box{
        padding: 15px;
        border-top: 1px solid #ccc;
    }
    .send-box form {
        align-items: center;
        justify-content: space-between;
    }
    #messageInput{
        width: 100%;
        padding: 2px 10px;
        height: 40px;
        border-radius: 20px 0px 0px 20px;
        border: solid 1px #dadada;
    }
    #messageInput:focus{
        outline: 0;
    }
    .btn-send{
        background: #000000;
        color: #fff;
        padding: 8px 20px;
        border: none;
    }
    #messageInput::placeholder {
        color: #aaa;
        font-style: italic;
        font-size: 14px;
    }
    #chatBox{
        height: calc(100vh - 16rem);
        padding: 10px;
        overflow-y: scroll;
        background: #f5efeb;
    }
    #chatBox .sender {
        display: block;
        width: 100%;
        position: relative;
    }
    #chatBox .repaly {
        display: block;
        width: 100%;
        text-align: right;
        position: relative;
    }
    #chatBox .sender p {
        color: #000;
        font-size: 14px;
        line-height: 1.5;
        font-weight: 400;
        padding: 10px 15px;
        background: #fff;
        display: inline-block;
        border-radius: 10px;
        margin-bottom: 2px;
        box-shadow: 0px 1px 1px 0px #c3c3c3;
    }
    #chatBox .sender:before {
        display: block;
        clear: both;
        content: '';
        position: absolute;
        top: -6px;
        left: -7px;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 12px 15px 12px;
        border-color: transparent transparent #fff transparent;
        -webkit-transform: rotate(-37deg);
        -ms-transform: rotate(-37deg);
        transform: rotate(-37deg);
    }
    #chatBox .repaly p {
        background: #d9fdd3;
        color: #292929;
        font-size: 14px;
        line-height: 1.5;
        font-weight: 400;
        padding: 10px 15px;
        background: #d9fdd3;
        display: inline-block;
        border-radius: 10px;
        margin-bottom: 2px;
        box-shadow: 0px 1px 2px 0px #aeaeae;
    }
    #chatBox .repaly:before {
        display: block;
        clear: both;
        content: '';
        position: absolute;
        top: -7px;
        right: -7px;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 8px 20px 20px;
        border-color: transparent transparent #d9fdd3 transparent;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .time {
        display: block;
        color: #000;
        font-size: 12px;
        line-height: 1.5;
        font-weight: 400;
        color: #939393;
        font-style: italic;
    }
    .sender, .repaly {
        margin: 15px 0;
    }
    @media (max-width: 767px) {
        .msg-right {
            width: 100%;
            position: absolute;
            left: 1000px;
            right: 0;
            background: #fff;
            transition: all 0.5s ease;
            border-left: none;
        }
        .msg-left {
            width: 100%;
        }
    }
    .showbox {
        left: 0 !important;
        transition: all 0.5s ease;
    }
</style>

<div class="msg-main">

    <!-- Sidebar: List of users -->
    <div class="msg-left">
        <ul id="userList" class="list-unstyled">
            <?php foreach ($users as $user): ?>
                <li class="mb-3">
                    <a href="#"
                       class="chat-link d-flex align-items-center"
                       data-user-id="<?= $user['id'] ?>"
                       data-user-name="<?= esc($user['name']) ?>"
                       data-user-image="<?= esc($user['image'] ?? 'assets/img/illustrations/profiles/profile-1.png') ?>">
                       <!-- <div class="d-flex gap-2 align-items-center"> -->
                            <div class="flex-shrink-0">
                                <img class="img-fluid" src="assets/img/illustrations/profiles/profile-1.png">
                            </div>

                            <div class="flex-grow-1 ms-3">
                                <h3><?= esc($user['name']) ?></h3>
                                <p><?= esc($user['role']) ?></p>
                                <?php if ($user['unseen_count'] > 0): ?>
                                    <span class="unseen-dot">• <?= $user['unseen_count'] ?></span>
                                <?php endif; ?>
                            </div>
                       <!-- </div> -->
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Chat Box -->
    <div class="msg-right" style="flex: 1;">
        <!-- Chat Header -->
        <div id="chatHeader" class="msg-head">

            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center">
                        <span class="chat-icon"><i class="fa fa-angle-left"></i></span>
                        <div class="flex-shrink-0">
                            <img id="chatUserImage" src="" class="img-fluid" alt="Image">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 id="chatUserName">User</h3>
                            <p>Landloard</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <div id="chatBox">
            <em>Select a user to start chatting.</em>
        </div>
        
        <div class="send-box">
            <!-- Send message form -->
            <form id="messageForm" style="display: none;">
                <input type="hidden" name="receiver_id" id="receiver_id" />
                <input type="text" name="body" id="messageInput" placeholder="Type your message" required />
                <button type="submit" class="btn-send"><i class="fa fa-paper-plane"></i></button>
            </form>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const chatBox = document.getElementById('chatBox');
    const messageForm = document.getElementById('messageForm');
    const receiverInput = document.getElementById('receiver_id');
    const messageInput = document.getElementById('messageInput');
    const chatHeader = document.getElementById('chatHeader');
    const chatUserName = document.getElementById('chatUserName');
    const chatUserImage = document.getElementById('chatUserImage');

    let activeUserId = null;
    let lastThreadHTML = '';

    function bindUserLinks() {
        const userLinks = document.querySelectorAll('.chat-link');
        userLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const userId = this.getAttribute('data-user-id');
                const userName = this.getAttribute('data-user-name');
                const userImage = this.getAttribute('data-user-image');

                activeUserId = userId;
                receiverInput.value = userId;

                // Set chat header
                chatUserName.textContent = userName;
                chatUserImage.src = userImage;
                chatHeader.style.display = 'block';

                loadThread(userId);
                messageForm.style.display = 'flex';
            });
        });
    }

    bindUserLinks();

    function loadThread(userId) {
        fetch(`/messages/thread/${userId}`)
            .then(response => response.text())
            .then(html => {
                if (html !== lastThreadHTML) {
                    chatBox.innerHTML = html;
                    chatBox.scrollTop = chatBox.scrollHeight;
                    lastThreadHTML = html;
                }
            });
    }

    messageForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(messageForm);

        fetch('/messages/send', {
            method: 'POST',
            body: formData,
        })
        .then(resp => resp.json())
        .then(data => {
            if (data.success) {
                loadThread(activeUserId);
                messageInput.value = '';
            }
        });
    });

    // Auto-refresh chat thread every 5 seconds
    // setInterval(() => {
    //     if (activeUserId) {
    //         loadThread(activeUserId);
    //     }
    // }, 5000);

    // Auto-refresh user list every 10 seconds
    setInterval(() => {
        fetch('/messages')
            .then(response => response.text())
            .then(html => {
                const tempDom = new DOMParser().parseFromString(html, 'text/html');
                const newUserList = tempDom.querySelector('#userList');
                const userListContainer = document.getElementById('userList');

                if (newUserList && userListContainer) {
                    userListContainer.innerHTML = newUserList.innerHTML;
                    bindUserLinks();
                }
            });
    }, 10000);
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

    // Get all the user list items
    const userListItems = document.querySelectorAll("#userList li");

    // Add click event to each user list item
    userListItems.forEach(function(item) {
        item.addEventListener('click', function() {
            // Show the chat area when a user is clicked
            document.querySelector(".msg-right").classList.add('showbox');
            return false; // Prevent default behavior (e.g., link navigation)
        });
    });

    // Get the chat icon
    const chatIcon = document.querySelector(".chat-icon");

    // When the chat icon is clicked, hide the chat area
    if (chatIcon) {
        chatIcon.addEventListener('click', function() {
            document.querySelector(".msg-right").classList.remove('showbox');
        });
    }
});

</script>

<?= $this->endSection() ?>
