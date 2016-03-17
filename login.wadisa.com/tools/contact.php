 <section id="contact">
        <div class="center">                
            <h2>Donde estamos</h2>
            <p class="lead">Desea visitarnos? </p>
        </div>
        <div class="gmap-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 text-center">
                        <div class="gmap">
                       <!--     <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=JoomShaper,+Dhaka,+Dhaka+Division,+Bangladesh&amp;aq=0&amp;oq=joomshaper&amp;sll=37.0625,-95.677068&amp;sspn=42.766543,80.332031&amp;ie=UTF8&amp;hq=JoomShaper,&amp;hnear=Dhaka,+Dhaka+Division,+Bangladesh&amp;ll=23.73854,90.385504&amp;spn=0.001515,0.002452&amp;t=m&amp;z=14&amp;iwloc=A&amp;cid=1073661719450182870&amp;output=embed"></iframe>-->
                            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6149.33864607088!2d2.677758199999997!3d39.589602399999976!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1446408608700"></iframe>
                        </div>
                    </div>

                    <div class="col-sm-7 map-content">
                        <ul class="row">
                            <li class="col-sm-6">
                                <address>
                                    <h5>Oficina Central</h5>
                                    <p>Calle Aragon 223 <br>
                                    Palma de Mallorca <br>
                                    CP 07008<br>
                                    Islas Baleares<br>
                                    España</p>
                                </address>

                                
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>  <!--/gmap_area -->

    <section id="contact-page">
        <div class="container">
            <div class="center">        
                <h2>Contactenos</h2>
                <p class="lead">Puede contactarnos por Email y le contestaremos a la brevedad.</p>
            </div> 
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Nombre *</label>
                            <input type="text" name="name" class="form-control" required="required" id="name" required data-validation-required-message="Por favor ingrese su nombre.">
                        </div>
                        <div class="form-group">
                            <label>Correo *</label>
                            <input type="email" name="email" class="form-control" required="required" id="email" required data-validation-required-message="Por favor ingrese su correo electronico.">
                        </div>
                        <div class="form-group">
                            <label>Telefono</label>
                            <input type="number" class="form-control" id="phone" required data-validation-required-message="Por favor ingrese su número de teléfono.">
                        </div>
                            
                    </div>
                    <div class="col-sm-5">
                        
                        <div class="form-group">
                            <label>Mensaje *</label>
                            <textarea name="message" required="required" class="form-control" rows="8" id="message" required data-validation-required-message="Por favor ingrese su mensaje."></textarea>
                        </div>                        
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Enviar mensaje</button>
                        </div>
                    </div>
                </form> 
            </div><!--/.row-->
        </div><!--/.container-->
    </section><!--/#contact-page-->