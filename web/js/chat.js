(function() {
    'use strict';
    var block_chat = document.querySelector(".chat-container");
    if (block_chat) block_chat.scrollTop = block_chat.scrollHeight;
    $('#submit_message').on('click', (e) => {
        e.preventDefault();
        $.ajax({
            url: "/message-send",
            type: "POST",
            data: {
                message: document.querySelector("#text_area").value
            },
            dataType: 'JSON',
            success: (result) => {
                if (result.status === 0) return message(result.message, 'error')
                if (result.status === 1) location.reload();
            }
        })
    })
    function message(text, type)
    {
        let settings = {
            "progressBar" : true
        };
        switch (type) {
            case 'success':
                toastr.success(text, '', settings)
                break;
            case 'error':
                toastr.error(text, '', settings)
                break;
            default:
                toastr.info(text, '', settings)
                break;
        }
    }
})()