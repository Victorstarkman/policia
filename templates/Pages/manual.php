<?= $this->Html->css(
	[  		'general/general_manual'
	]) ?>
<div class="mx-auto mt-5 col-12">
    <div class="col-12 title-section">
        <h4>Manual de Usuario Para la ejecuci&oacute;n de Preocupacionales a Polic&iacute;a de Buenos Aires </h4>
    </div>
    <div class="results">
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
                        <div class="col-4 col-md-4">
						    <?php echo $this->Html->image('portal.jpg', ['alt' => 'portal','class'=>'admin-foto', 'style' => 'width:100%']);?>
                            <p><small class="text-center">Fig 1</small></p>
                        </div>
                        <div class="col-8">
                            <p class="admin_p">El personal administrativo de Dienst usar&aacute; la direcci&oacute;n <a href="https://dienstpreos.com.ar/policiabsas">https://dienstpreos.com.ar/policiabsas </a>para entrar en la plataforma utilizando
                                el navegador de su preferencia<br> Para esto debera disponer de un usuario registrado que consiste en el mail y una contrase&ntilde;a dada por los administradores de la plataforma.
                                utilizando los campos se&ntilde;alados por los iconos de <?= $this->Html->image('icons/blue/email-blue.png',['alt'=>'mail'])?> para usuario y de <?= $this->Html->image('icons/blue/lockpad-blue.png',['alt'=>'candado'])?> para la contrase&ntilde;a
                            </p>
                        </div>
                    </div>
                    <p>Una vez ingrese a la p&aacute;gina encontrar&aacute; las siguientes funcionalidades</p>
                    <div class="row">
                        <div class="col-4 col-xs-12">
						    <?= $this->Html->image('Menu_admin.png',['alt'=>'menu','class'=>'admin_menu', 'style' => 'width:100%'])?>
                            <p><small class="text-center">Fig 2</small></p>
                        </div>
                        <div class="col-8 col-xs-12">
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
                        <div class="col-4">
						    <?= $this->Html->image('centro_medico.png',['alt'=>'menu_centro_medico','class'=>'menu_centro_medico', 'style' => 'width:100%'])?>
                            <p><small>Fig 3</small></p>
                        </div>
                        <div class="col-8">
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
                        <?php $apiUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/policiabsas/api';?>
                        La polic&iacute;a recibir&aacute; un usuario y contrase&ntilde;a.<br/><br/>
                        Con estos generar&aacute; una petici&oacute;n POST a la siguiente URL:<br/>
                        <strong><?php echo $apiUrl ?>/login</strong> <br/>
                        el body de la petici&oacute;n debe contener un json con los siguientes datos:<br/><br/>
                        {<br/>
                            email: {{email}},<br/>
                            password: {{contraseña}}<br/>
                        }<br/><br/>
                        Esta petici&oacute;n genera un token para poder comunicarse con la API. Este Token deber&aacute; viajar en el header de Authorization en todas las proximas peticiones<br/><br/><br/>
                        Ejemplo de respuesta:<br/>
	                    <?= $this->Html->image('examples/token.png',['alt'=>'menu_centro_medico','class'=>'menu_centro_medico', 'style' => 'width:100%'])?><br/><br/>

                        Endpoints disponibles para consultas:<br/>
                        1. <?= $apiUrl;?>/preocupacionales<br/>
                        La patici&oacute;n deber&aacute; viajar con el header: Authorization Bearer {{token}}<br/><br/>
                        Este devolerdeber&aacute; toda la baser de datos disponible de los aspirantes en formato JSON.<br/><br/>
                        2. <?= $apiUrl;?>/preocupacionales?begin_date={{fecha de inicio}}&end_date={{fecha de final}}<br/>
                        Se puede indicar una fecha de inicio y una de final en formato "YYYY-mm-dd". Este endpoint devolver&aacute; los datos
                        disponibles entre esas fechas.<br/><br/>
                        Ejemplo de respuesta:<br/>
	                    <?= $this->Html->image('examples/preocupacionales.png',['alt'=>'menu_centro_medico','class'=>'menu_centro_medico', 'style' => 'width:100%'])?>

                    </p>
                    <div class="float-right mt-4"><span><a href="<?= $this->Url->build('#general',['fullBase'=>true])?>">⏫Volver</a></span></div>
                </article>
            </div>

        </div>
    </div>
</div>