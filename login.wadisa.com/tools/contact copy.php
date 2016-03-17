 <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contacto</h2>
                    <h3 class="section-subheading text-muted">Si tiene alguna duda, puede contactarnos rellenando el siguiente formulario.</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                          <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input type="text" class="form-control" placeholder="Nombre *" id="name" required data-validation-required-message="Por favor ingrese su nombre.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                          <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="email" class="form-control" placeholder="Correo *" id="email" required data-validation-required-message="Por favor ingrese su correo electronico.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                          <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt"></i></span>
                                    <input type="tel" class="form-control" placeholder="Teléfono *" id="phone" required data-validation-required-message="Por favor ingrese su número de teléfono.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                          <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                                    <textarea class="form-control" placeholder="Mensaje *" id="message" required data-validation-required-message="Por favor ingrese su mensaje."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Enviar Mensaje</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
