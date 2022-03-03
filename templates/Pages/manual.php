<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="shortcut icon" href="assets/img/favicon.jpg" type="image/x-icon">
        <?= $this->Html->meta('icon', 'favicon.jpg'); ?>
        <?= $this->Html->css(
	        [  
                'general/icons',
                'general/general_manual'
            ]) ?>
        <?php $this->fetch('css')?>
        <?php $this->fetch('meta')?>
    <title>Manual de Usuario de Preos de Policia</title>
</head>
<body>
        <div class="head ">
            <div class="row ">
            <div class="logo col-2 col-md-2" >
                <?= $this->Html->image('img2.jpg',['alt'=>"logoDienst"])?>
            </div>
            <div class="col-10 col-md-10 text-center title">
                <h1>Manual de Usuario Para la ejecuci&oacute;n de Preocupacionales a Polic&iacute;a de Buenos Aires </h1>
            </div>
            </div>
        </div>
        <div>
            <div class="row">
                    <div class="col-2 col-md-2">
                        <div class="side-bar">
                            <h2>Menu</h2>
                            <ul class="links">
                                <li><a href="<?= $this->Url->build('#general',['fullBase'=>true])?>">General</a></li>
                                <li><a href="<?= $this->Url->build('#admin',['fullBase'=>true])?>">Administraci&oacute;n</a></li>
                                <li><a href="<?= $this->Url->build('#centro_medico',['fullBase'=>true])?>">C.M&eacute;dico</a></li>
                                <li><a href="<?= $this->Url->build('#policia',['fullBase'=>true])?>">Polic&iacute;a</a></li>
                                <li><a href="<?= $this->Url->build(['controller'=>'Dienst/Candidates'])?>">Salir <i class="fas fa-sign-out-alt"></i></a></li>
                             </ul>
                        </div>
                    </div>
 
                <div class="col-9 col-md-9" id="general">
                    <article >
                        <header>
                            <h2>General</h2>
                        </header>
                        <p>El objetivo del sistema es proveer un soporte a la realizaci&oacute;n de ex&aacute;menes preocupacionales destinados a la Polic&iacute;a de Buenos Aires.<br>
                            El personal que puede ser afectado por estos ex&aacute;menes son: Cadetes, Bomberos, Nice, Agentes de Prevenci&oacute;n y Personal sin Estado Policial.<br>
                            El proceso comienza por la recepci&oacute;n de un listado de aspirantes suministrados por las autoridades policiales que han completado el procedimiento hasta
                            el punto de laboratorio. Es ahi que el personal administrativo de Dienst ingresa los datos de los aspirantes y se les otorga un turno en un centro m&eacute;dico
                            que comprende el d&iacute;a,la hora y la direcci&oacute;n del centro m&eacute;dico .<br>
                            El centro m&eacute;dico en cuesti&oacute;n recibir&aacute; el listado diario de aspirantes con el tipo de ex&aacute;men preocupacional a realizar.
                            La funci&oacute;n del centro m&eacute;dico consistir&aacute; en cargar los documentos de los aspirantes y su foto.<br>
                            Una vez finalizada la carga El personal administrativo de Dienst pondra a disposici&oacute;n los documentos al personal profesional m&eacute;dico de la empresa y ellos
                            dar&aacute;n su diagn&oacute;stico que puede ser Apto, No Apto o Apto con preexistencia. En el caso de estos dos &uacute;ltimos tendr&aacute a su disposici&oacute;n un campo 
                            de observaciones para detallar las razones de su diagn&oacute;stico.
                            Finalizado el proceso la Polic&iacute;a dispondra de los datos de los aspirantes, su documentacion,fotograf&iacute;a y diagn&oacute;stico del aspirante.
                        </p>
                    </article>
                    <div id="admin">
                        <article >
                            <header>
                                <h2>Administraci&oacute;n de Dienst</h2>
                            </header>
                            <div class="row">
                                <div class="col-4">
                                    
                                    <?php echo $this->Html->image('portal.jpg', ['alt' => 'portal','class'=>'admin-foto']);?>
                                    <p><small class="text-center">Fig 1</small></p>
                                </div>
                                <div class="col-6 ml-5">
                                    <p class="admin_p">El personal administrativo de Dienst usar&aacute; la direcci&oacute;n <a href="https://dienstpreos.com.ar/policiabsas">https://dienstpreos.com.ar/policiabsas </a>para entrar en la plataforma utilizando 
                                el navegador de su preferencia<br> Para esto debera disponer de un usuario registrado que consiste en el mail y una contrase&ntilde;a dada por los administradores de la plataforma. 
                                utilizando los campos se&ntilde;alados por los iconos de <?= $this->Html->image('icons/blue/email-blue.png',['alt'=>'mail'])?> para usuario y de <?= $this->Html->image('icons/blue/lockpad-blue.png',['alt'=>'candado'])?> para la contrase&ntilde;a
                                    </p>
                                </div>
                            </div>
                            <p>Una vez ingrese a la p&aacute;gina encontrar&aacute; las siguientes funcionalidades</p>
                            <div class="row">
                                <div class="col-3 col-md-3">
                                    <?= $this->Html->image('Menu_admin.png',['alt'=>'menu','class'=>'admin_menu'])?>
                                    <p><small class="text-center">Fig 2</small></p>
                                </div>
                                <div class="col-9 col-md-9">
                                        <p><span class="subtitulo">Lista de Aspirantes:</span> Es el listado de los aspirantes desde donde se puede dar turnos;ver datos personales y modificarlos y <strong>si el aspirante aun no tiene turno otorgado</strong> puede ser eliminado de la lista.<br>
                                        En el caso de pertenecer al personal m&eacute;dico y tener su contrase&ntilde;a podr&aacute; ingresar a la p&aacute;gina de diagn&oacute;stico .<br>
                                        <span>Asignaci&oacute;n Grupal de turnos:</span> Es el acceso a la p&aacute;gina de asignaciones de turnos en forma grupal; en el caso de que varios aspirantes tengan el mismo 
                                        dia y hora para sus ex&aacute;menes.<br>
                                        <span>Lista de presentes sin diagnosticar:</span> Este v&iacute;nculo le permite al usuario si es  administrador ver a los aspirantes que estuvieron presentes y que tienen todos los documentos cargados por el centro m&eacute;dico pero a&uacute;n estan a la espera de
                                        diagn&oacute;stico. En el caso de ser personal m&eacute;dico de la empresa podr&aacute; dar su diagn&oacute;stico al aspirante.
                                    </p>
                                    <div class="float-right mt-4"><span><a href="<?= $this->Url->build('#general',['fullBase'=>true])?>">⏫Volver</a></span></div>
                                </div>
                            </div>   
                            
                         
                        </article>       
                    </div>
                    <div id="centro_medico">
                        <article >
                            <header>
                                <h2>Centro de Atenci&oacute;n M&eacute;dica</h2>
                            </header>
                            <p>El usuario de centro de atenci&oacute;n m&eacute;dica dispondr&aacute;de su contrase&ntilde;a y usuario y proceder&aacute; como lo indicado
                                en la figura 1. Entonces tendr&aacute; a su disposicion el siguiente menu.
                            </p>
                            <div class="row">
                                <div class="col-3 col-md-3">
                                    <?= $this->Html->image('centro_medico.png',['alt'=>'menu_centro_medico','class'=>'menu_centro_medico'])?>
                                    <p><small>Fig 3</small></p>
                                </div>
                                <div class="col-9 col-md-9">
                                    <p>
                                        <span>Lista diaria de aspirante:</span> Esta es la lista que diariamente recibe el centro m&eacute;dico donde puede dar Presente o Ausente al aspirante.<br>
                                        En el caso de que este este presente se abre una p&aacute;gina donde puede cargarse la foto y los documentos del aspirante. 
                                        Hay un limite de 10 documentos y de 5Mb por documento.<br>
                                        <span>Lista de Presentes con estudios pendientes:</span> Esta p&aacute;gina permite cargar los documentos de aspirantes que a&uacute;n quedan pendientes de carga 
                                        para finalizar todos los estudios. De no tener finalizados la carga el personal m&eacute;dico de Dienst no podr&aacute; dar su diagn&oacute;tico.<br>
                                    </p>
                                    <div class="float-right mt-4"><span><a href="<?= $this->Url->build('#general',['fullBase'=>true])?>">⏫Volver</a></span></div>
                                </div>
                            </div>
                        </article>   
                    </div>
                    <div id="policia">
                        <article>
                            <header>
                                <h2>Polic&iacute;a</h2>
                            </header>
                            <p>
                                La polic&iacute;a recibir&aacute; un usuario y contrase&ntilde;a. Con estos generar&aacute; un pedido de post a la siguiente direcci&oacute;n y destino. <br>
                                url: "https://www.dienstpreos.com.ar"  destino= "policiabsas" <br/>
                                <strong>direccion completa de POST</strong> {{url}}/{{destino}}/api/login. y keys: email:usuario y password:contrase&ntilde;a. <br>
                                Este post generar&aacute; un token el cual dar&aacute; acceso a dos ordenes GET<br>
                                Un GET {{url}}/{{destino}}/api/preocupacionales que incluye al token y este devolvera toda la base de datos disponible de los aspirantes en formato JSON. <br>
                                Tambien tendran a disposicion un segundo GET que les permitir&aacute; realizar consultas a la base de datos de acuerdo a fecha de inicio y fecha de finalizaci&oacute;n.<br>
                                Este GET tendr&aacute; el siguiente url {{{url}}/{{destino}}/api/preocupacionales?begin_date={{fecha de inicio}}&end_date={{fecha de final}} <br>
                                donde el formato de fechas deber&aacute; responder a "YY-mm-dd"
    
                            </p>
                            <div class="float-right mt-4"><span><a href="<?= $this->Url->build('#general',['fullBase'=>true])?>">⏫Volver</a></span></div>   
                        </article>     
                    </div>
                        
                </div>
            </div>
        </div>      
</body>
</html>