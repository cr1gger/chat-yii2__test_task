(function() {
    'use strict';
    $('.event_select').on('change', (e) => {
        let user_id = e.target.name.split('_')[2];
        let value = e.target.value;
        $.ajax({
            url: '/admin/change-role',
            type: 'post',
            dataType: 'json',
            data: {
                user_id,
                value
            },
            success: (result) => {
                if (result.status === 1) return toastr.success(result.message);
                toastr.error(result.message);
            }
        })
    })
})()