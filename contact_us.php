<div class="col-12">
    <div class="row my-5 ">
        <div class="col-md-5">
            <div class="card card-outline card-navy rounded-0 shadow">
                <div class="card-header">
                <h4 class="card-title">Contacto</h4>
                </div>
                <div class="card-body rounded-0">
                    <dl>
                        <dt class="text-muted"><i class="fa fa-envelope"></i> Correo</dt>
                        <dd class="pl-4"><?= $_settings->info('email') ?></dd>
                        <dt class="text-muted"><i class="fab fa-whatsapp"></i><a href="https://configuroweb.com/WhatsappMessenger" target="_blank"> Whatsapp</a></dt>
                        <dd class="pl-4"><a href="https://configuroweb.com/WhatsappMessenger" target="_blank"><?= $_settings->info('contact') ?></a></dd>
                        <dt class="text-muted"><i class="fa fa-map-marked-alt"></i> Dirección</dt>
                        <dd class="pl-4"><?= $_settings->info('address') ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card rounded-0 card-outline card-navy shadow" >
                <div class="card-body rounded-0">
                    <h2 class="text-center">Escríbenos</h2>
                    <center><hr class="bg-navy border-navy w-25 border-2"></center>
                    <?php if($_settings->chk_flashdata('pop_msg')): ?>
                        <div class="alert alert-success">
                            <i class="fa fa-check mr-2"></i> <?= $_settings->flashdata('pop_msg') ?>
                        </div>
                        <script>
                            $(function(){
                                $('html, body').animate({scrollTop:0})
                            })
                        </script>
                    <?php endif; ?>
                    <form action="" id="message-form">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm form-control-border" id="fullname" name="fullname" required placeholder="Tu nombre completo">
                                <small class="px-3 text-muted">Nombre</small>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control form-control-sm form-control-border" id="contact" name="contact" required placeholder="+57 3xx-xxxxxxx">
                                <small class="px-3 text-muted"># de Contacto</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="email" class="form-control form-control-sm form-control-border" id="email" name="email" required placeholder="tu-correo@cweb.com">
                                <small class="px-3 text-muted">Correo</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <small class="text-muted">Mensaje</small>
                                <textarea name="message" id="message" rows="4" class="form-control form-control-sm rounded-0" required placeholder="Escribe tu consulta en este apartado"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 text-center">
                                <button class="btn btn-primary rounded-pill col-5">Enviar mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#message-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_message",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("Ocurrió un error.",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload();
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("Ocurrió un error desconocido.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html, body').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>