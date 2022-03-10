@extends('layouts.panel')


@section('content')
  <div class="card shadow">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0"><i class="ni ni-book"></i> Centro de apoyo</h3>
        </div>
        <div class="col-md-6">
          <a href="/home" class="btn btn-outline-default">
          <i class="ni ni-bold-left"></i> Volver
          </a>
        </div>
      </div>
    </div>
    <div class="table-responsive">
    <div class="card-body">

      @if($errors->any())
        <div class="alert alert-danger" role="alert">
          <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}
          </li>
          @endforeach
          <ul>
        </div>
      @endif



        <div class="col-md-12">
          <div class="row">              

           
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">  
			  <div class="card-body">
			    <h1 class="card-title text-white">¿ Como registrarse en el portal ?</h1>
			    <p class="card-text">Inicialmente los más recomendable es solicitarle el enlace de registro la persona que lo contacto, ponerlo en el su buscador de confianza y hacer el registro desde ese enlace, esto debido a que este enlace ya trae automáticamente el id de la persona que lo refiere, campo muy importante para un registro exitoso en el portal.</p>	    
			    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-form1"  href="#">Instrucciones</button>
			  </div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
			  	<div class="card-body">
				    <h1 class="card-title">¿ Como ingreso al portal ?</h1>
				    <p class="card-text text-default">Ingresar el email con el que se registró, la contraseña, aceptar términos y condiciones con el botón de verificación y después hacer clic en ingresar.</p>	    
				    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-form2"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
				<div class="card-body">
				    <h1 class="card-title text-white">¿ Como puedo compartir el enlace de registro a mis referidos ?</h1>
				    <p class="card-text">En la pantalla inicial al lado derecho superior hacer clic en el nombre de usuario, se despliega un menú en el cual escogemos Mi perfil...</p>	    
				    <button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modal-form3"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
			  <div class="card-body">
				    <h1 class="card-title text-white">¿ Como cambiar mi foto de perfil en el portal ?</h1>
				    <p class="card-text">En la pantalla inicial al lado derecho superior hacer clic en el nombre de usuario, se despliega un menú, en el cual escogemos Mi perfil...</p>	    
				    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-form4"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;			
			<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
			  <div class="card-body">
				    <h1 class="card-title text-white">¿ Qué funcionalidad tiene la opción escritorio ?</h1>
				    <p class="card-text">La opción escritorio es la pantalla inicial que se muestra al ingresar al portal, algunos mensajes de información de una acción o proceso por parte del usuario se despliegan en esta pantalla...</p>	    
				    <button type="button" class="btn btn-outline-white" data-toggle="modal" data-target="#modal-form5"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
			  <div class="card-body">
				    <h1 class="card-title text-white">¿ Qué funcionalidad tiene la opción noticias ?</h1>
				    <p class="card-text">En noticias se puede ver información relevante sobre el portal o información relacionada con los usuarios sirve para dar nueva información.</p>	    
				    <button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modal-form7"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card bg-light mb-3" style="max-width: 18rem;">
			  <div class="card-body">
				    <h1 class="card-title">¿ Como compro una membresía en la tienda  ?</h1>
				    <p class="card-text">En la tienda el usuario puede visualizar las diferentes membresías disponibles y al darle clic en alguna de ellas puede ver la wallet a donde se hace el giro para adquirir una...</p>	    
				    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-form8"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
			  <div class="card-body">
				    <h1 class="card-title text-white">¿ Qué funcionalidad tiene la opción mis membresías ?</h1>
				    <p class="card-text">En mis membresías podemos ver el historial de cuantas, y cuales membresías hemos adquirido, el historial de pago diario de cada una de ellas, ver los pagos que nos han generados por activación de otros usuarios que son nuestros referidos y los días que nos restan para que se cierre dicha membresía</p>	    
				    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-form9"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">  
			  <div class="card-body">
			    <h1 class="card-title text-white">¿ Como puedo renovar mi membrecía cuando ya ha cerrado ?</h1>
			    <p class="card-text">En mis membresías seleccionó la membresía que quiero renovar...</p>	    
			    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-form11"  href="#">Instrucciones</button>
			  </div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
			  	<div class="card-body">
				    <h1 class="card-title">¿ Qué es la opción red ?</h1>
				    <p class="card-text text-default">Red es para visualizar todos los usuarios que son nuestros referidos, el estado de la membresía y los pagos que tenemos por activación de estos.</p>	    
				    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-form12"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
				<div class="card-body">
				    <h1 class="card-title text-white">¿ Qué funcionalidad tiene la opción billetera ?</h1>
				    <p class="card-text">En la opción billetera el usuario puede ver su estado de cuenta, un formulario para solicitar un traslado y el historial de los traslados que ha realizado.</p>	    
				    <button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modal-form13"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
			  <div class="card-body">
				    <h1 class="card-title text-white">¿ Como solicito un traslado en el portal ?</h1>
				    <p class="card-text">En billetera podemos solicitar traslados de saldo, mira como...</p>	    
				    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-form14"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card text-white bg-warning mb-3" style="max-width: 18rem;">
			  <div class="card-body">
				    <h1 class="card-title text-white">¿ Como puedo contactarme con el administrador del portal  ?</h1>
				    <p class="card-text">En el menú lateral izquierdo, hacemos clic en contacto...</p>	    
				    <button type="button" class="btn btn-outline-white" data-toggle="modal" data-target="#modal-form15"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;
			<div class="card text-white bg-info mb-3" style="max-width: 18rem;">
			  <div class="card-body">
				    <h1 class="card-title text-white">¿ En dónde puedo ver los Términos y condiciones ?</h1>
				    <p class="card-text">Podemos ver los términos y condiciones en dos lugares en el portal...</p>	    
				    <button type="button" class="btn btn-outline-default" data-toggle="modal" data-target="#modal-form16"  href="#">Instrucciones</button>
			  	</div>
			</div>&nbsp;&nbsp;&nbsp;



			<div class="modal fade" id="modal-form1" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Registro</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/Registro ARluxury.mp4') }}" controls> Video no es soportado... </video> Regitrarse en el portal ARLUXURY                    
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en registro
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st1.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st1.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st1.PNG"></a>
	                             </strong>
	                             <br><br>	                             
	                             	Diligenciar todos los campos del formulario de registro, en el primer campo es importante poner el código de quien lo refiere, este código se lo puede solicitar a la persona que lo contacto, después de llenar todos los campos hacemos clic en registrarse. 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st2.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st2.PNG') }}"
	                             ></a>                                   

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form2" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Ingreso</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/Ingresar a arluxury.mp4') }}" controls> Video no es soportado... </video> Ingresar en el portal ARLUXURY                    
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en registro
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st3.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st3.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st3.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Ingresar el email con el que se registró, la contraseña, aceptar términos y condiciones con el botón de verificación y después hacer clic en ingresar. 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st4.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st4.PNG') }}"
	                             ></a>                                                                

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form3" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Enlace</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/Compartir enlace de registro.mp4') }}" controls> Video no es soportado... </video> Compartir enlace de registro                     
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en Mi perfil
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st5.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st5.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st5.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Después hacemos clic en link 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st6.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st6.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             	Nos arrojara una ventana emergente en donde podremos copiar el enlace y compartirlo, por favor copiar el enlace completo
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st7.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st7.PNG') }}"
	                             ></a>                                                          

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form4" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Perfil</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/Cambiar foto de perfil.mp4') }}" controls> Video no es soportado... </video> Cambiar foto del perfil                    
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en Mi perfil
	                           	<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st5.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st5.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st5.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Adjuntamos la imagen que queremos dejar de perfil y hacemos clic en editar usuario. 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st8.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st8.PNG') }}"
	                             ></a>       
	                             <br><br>                                                      

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form5" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Escritorio</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/Ingresar a Futurs.mp4') }}" controls> Video no es soportado... </video><br>  Ver escritorio                   
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en escritorio
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st9.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st9.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st9.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Es un espacio que se destinó para futuras actualizaciones.
	                             <br><br> 
	                             <a href="{{ asset('img/brand/img-guia-st10.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st10.PNG') }}"
	                             ></a>       
	                             <br><br>                                                          

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form6" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Ingreso</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/Cambiar foto de perfil.mp4') }}" controls> Video no es soportado... </video> Escritorio                    
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en escritorio
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st9.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st9.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st9.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Podremos ver el escritorio. 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st10.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st10.PNG') }}"
	                             ></a>       
	                             <br><br>                                                          

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form7" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Noticias</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/noticias.mp4') }}" controls> Video no es soportado... </video><br> Las noticias                    
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en noticias
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st11.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st11.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st11.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Después podremos ver las ultimas noticias o información mas relevante sobre el portal.
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st12.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st12.PNG') }}"
	                             ></a>       
	                             <br><br>                                                          

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form8" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Tienda</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/Comprar membresia en arluxur.mp4') }}" controls> Video no es soportado... </video><br> Ingresar a la tienda y comprar una membresia                   
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en tienda
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st13.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st13.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st13.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Clic en la membresía y divisa que se quiere comprar
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st14.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st14.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             	Se visualiza el código QR o la wallet donde se consignará el valor de esta, y se da clic en registrar has de pago
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st15.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st15.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             Se despliega un formulario para diligenciar los datos del has de pago y la membresía que se va a adquirir,</n>
								 seleccionamos el valor de la membresía 
								 <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st16.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st16.PNG') }}"
	                             ></a>   
	                             <br><br>
	                             Si contamos con una imagen del pago la adjuntamos y si no dejamos ese campo en blanco 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st17.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st17.PNG') }}"
	                             ></a>   
	                             <br><br>
	                             Digitamos los dos has de pago que nos arroje el sistema en donde se hizo el giro o la consignación 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st18.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st18.PNG') }}"
	                             ></a>   
	                             <br><br> 
	                             Hacemos clic en enviar
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st19.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st19.PNG') }}"
	                             ></a>
	                             <br><br>
	                             Esperamos al que el portal nos indique que el proceso transcurrió con éxito y también a que el administrador del portal valide la información quien después procederá a activar la membresía, el portal le enviara una notificación por correo con información del cambio de estado de su membresía
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st20.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st20.PNG') }}"
	                             ></a>   
	                             <br><br>                                                       

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form9" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Membresias</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/mis membresias en arluxury.mp4') }}" controls> Video no es soportado... </video><br> Mis membresias                    
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en mis membresías
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st21.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st21.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st21.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Podemos visualizar los datos de mis membresías y los días que restan para que se cierre dicha membresía
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st22.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st22.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             	Para ver el historial de pago diario de una membresía hacemos clic en Historial diarios 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st23.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st23.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             Nos mostrara una tabla con el historial de pago diario de la membresía seleccionada 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st24.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st24.PNG') }}"
	                             ></a>   
	                             <br><br>
	                             Para ver el historial de pago por activación hacemos clic en Historial activación
	                             <br><br>  
	                             <a href="{{ asset('img/brand/img-guia-st25.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st25.PNG') }}"
	                             ></a>   
	                             <br><br>
	                             Nos mostrara una tabla con el historial de los pagos por activación 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st26.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st26.PNG') }}"
	                             ></a>   
	                             <br><br>                                                   

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form10" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Membresias</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/Comprar membresia en futurs.mp4') }}" controls> Video no es soportado... </video><br> Mis membresias                    
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en mis membresías
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st21.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st20.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st20.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Podemos visualizar los datos de mis membresías y los días que restan para que se cierre dicha membresía
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st21.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st21.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             	Para ver el historial de pago diario de una membresía hacemos clic en Historial diarios 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st22.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st22.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             Nos mostrara una tabla con el historial de pago diario de la membresía seleccionada 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st23.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st23.PNG') }}"
	                             ></a>   
	                             <br><br>
	                             Para ver el historial de pago por activación hacemos clic en Historial activación  
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st24.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st24.PNG') }}"
	                             ></a>   
	                             <br><br>
	                             Nos mostrara una tabla con el historial de los pagos por activación 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st25.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st25.PNG') }}"
	                             ></a>   
	                             <br><br>                                                   

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form11" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Membresias</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/Renovar membresia en arluxury.mp4') }}" controls> Video no es soportado... </video><br> Renovar membresía                    
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en mis membresías
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st21.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st21.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st21.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	En mis membresías seleccionó la membresía que quiero renovar, esta debe estar en estado cerrado y le doy clic en el enlace que dice renovar
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st27.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st27.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             	En la pantalla que se nos presenta validamos que sea la membresía que elegimos y le damos clic en renovar  
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st28.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st28.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             Esperamos a que el portal nos indique que la operación fue exitosa 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st29.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st29.PNG') }}"
	                             ></a>   
	                             <br><br>
	                             Después vamos a mis membresías y validamos que tengamos la membresía activa  
	                             <br><br> 
	                             <a href="{{ asset('img/brand/img-guia-st30.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st30.PNG') }}"
	                             ></a>   
	                             <br><br>                                                  

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form12" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Red</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/red.mp4') }}" controls> Video no es soportado... </video><br> Mi red                   
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en red 
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st31.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st31.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st31.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Aquí podremos ver nuestra red
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st32.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st32.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             	y los pagos por activación
	                             <br><br>    
	                             <a href="{{ asset('img/brand/img-guia-st33.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st33.PNG') }}"
	                             ></a>       
	                             <br><br>
	                                                                              

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form13" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Billetera</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/Billetera arluxury.mp4') }}" controls> Video no es soportado... </video><br> Billetera y traslados                   
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en billetera
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st34.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st34.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st34.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Se nos despliega la pantalla con el balance de la cuenta al lado izquierdo
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st35.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st35.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             	Al lado derecho, si cumplimos con las condiciones del portal, podremos ver un formulario para realizar la solicitud de traslado de saldo 
	                             <br><br> 
	                             <a href="{{ asset('img/brand/img-guia-st36.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st36.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             Y al final de la ventana los movimientos que se han realizado por parte del usuario 
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st37.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st37.PNG') }}"
	                             ></a>   
	                             <br><br>                                                 

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form14" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Billetera</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/Traslado ARluxury.mp4') }}" controls> Video no es soportado... </video><br> Hacer un traslado                   
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en billetera
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st34.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st34.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st34.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	En el formulario del lado derecho, se diligencian los campos, doy clic en enviar traslado, espero a que el portal me indique que la operación fue procesada con éxito y valido la notificación que me llegara al correo sobre el estado de mi traslado, después de que el administrador valide la información cambiara de estado la solicitud y será notificado por correo electrónico
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st38.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st38.PNG') }}"
	                             ></a>       
	                             <br><br>
	                             	Si quiero verificar mi movimiento de saldo, puedo ir al final de la ventana y validarlo en el historial de movimientos
	                             <br><br> 
	                             <a href="{{ asset('img/brand/img-guia-st39.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st39.PNG') }}"
	                             ></a>       
	                             <br><br>                                               

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form15" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>Contacto</small><br><br>
	                          <video width="300px" src="{{ asset('img/brand/correo.mp4') }}" controls> Video no es soportado... </video><br> Enviar correo al adminnistrador                   
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		Clic en contacto
	                           		<br><br>
	                             	<a href="{{ asset('img/brand/img-guia-st40.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st40.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st40.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Se presentará un formulario para escribir el mensaje, después le damos clic en el botón de enviar
	                             <br><br>
	                             <a href="{{ asset('img/brand/img-guia-st41.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st41.PNG') }}"
	                             ></a>       
	                             <br><br>  
	                             	y esperamos la respuesta por parte del administrador      
	                             <br><br>
	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	          <div class="modal fade" id="modal-form16" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	          <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
	            <div class="modal-content">
	              
	              <div class="modal-body p-0">
	                  
	                      
	                <div class="card bg-secondary shadow border-0">
	                    <div class="card-header bg-transparent pb-5">
	                        <div class="text-muted text-center mt-2 mb-3"><small>T & C</small><br><br>
	                          Ver los términos y condiciones                  
	                        </div>                      
	                    </div>
	                    <div class="card-body px-lg-5 py-lg-5">                      
	                    		<small></small>
	                           		 En el formulario de inicio de sesión del portal, hacer clic en acepto términos y condiciones
	                           		 <br><br> 
	                             	<a href="{{ asset('img/brand/img-guia-st42.PNG') }}" target="_blank"><img src="{{ asset('img/brand/img-guia-st42.PNG') }}" targer="http://127.0.0.1:8000/img/brand/img-guia-st42.PNG"></a>
	                             </strong>
	                             <br><br>
	                             	Al final de cada página, en la parte inferior derecha
	                             	<br><br>
	                             <a href="{{ asset('img/brand/img-guia-st43.PNG') }}" target="_blank"><img width="300px" style="img.style.transform = 'scale(1.9)'" src="{{ asset('img/brand/img-guia-st43.PNG') }}"
	                             ></a>       
	                             <br><br>                                              

	                    </div>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
             


          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
