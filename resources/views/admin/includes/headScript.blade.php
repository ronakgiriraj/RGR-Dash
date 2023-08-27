<script>
    function returnModel(btn, url, type, renderContainer, extraFunction){
        if($(btn).hasClass('button__loader') === false){
            var isLogin;
            $(btn).addClass('button__loader');

            $.ajax({
                url:'/{{ getAdminUrl() }}/login/check',
                type:'get',
                data: { _token: '{{ csrf_token() }}' },
                success:function(result){
                    isLogin = result;

                    if(isLogin == '1'){
                        $.ajax({
                            url:url,
                            type:type,
                            success:function(result){
                                $(renderContainer).html(result);
                                extraFunction();
                                $(btn).removeClass('button__loader');
                            },
                            error: function (err) {
                                $(btn).removeClass('button__loader');
                            }
                        });
                    }else{
                        $(renderContainer).html(isLogin);
                        $(btn).removeClass('button__loader');
                        $('#loginModal').show();
                    }
                },
                error: function (err) {
                }
            })
        }
    }
    function makeFormSubmit(form, btn, url, afterSuccess){
        $(form).submit(function(e) {
            e.preventDefault();

            $(btn).prop('disabled', true);
            $(btn).addClass('button__loader');
            $('.invalid-feedback').remove();
            $('.is-invalid').removeClass('is-invalid');
            var data = new FormData(this);
            $.ajax({
                url:url,
                data: data,
                contentType: false,
                processData: false,
                type:'post',
                success:function(result){
                    afterSuccess(result);

                    Swal.fire({
                        title: result.msg,
                        timer: 2000,
                        icon: 'success',
                    });

                    $(btn).removeClass('button__loader');
                    $(btn).prop('disabled', false);

                    location.reload();
                },
                error: function (err) {
                    if (err.status == 422) { // when status code is 422, it's a validation issue
                        console.log(err.responseJSON);
                        $('#success_message').fadeIn().html(err.responseJSON.message);

                        // display errors on each form field
                        $.each(err.responseJSON.errors, function (i, error) {
                            var el = $(document).find('[name="'+i+'"]');
                            el.addClass('is-invalid');
                            el.after($('<div class="invalid-feedback">'+error[0]+'</div>'));
                        });
                    }

                    $(btn).removeClass('button__loader');
                    $(btn).prop('disabled', false);
                }
            });
        });
    }

    function imageRender(){
        $('.uploadInput').change(function (){
            const file = this.files[0];
            var show = '#'+$(this).attr('uploadRender');

            if (file){
            let reader = new FileReader();
            reader.onload = function(event){
                $(show).attr('src', event.target.result);
            }
            reader.readAsDataURL(file);
            }
        });
    }

</script>
