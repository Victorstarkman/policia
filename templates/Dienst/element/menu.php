<div class="card">
    <div class="card-header" id="pacientes">
        <h2 class="mb-0">
            <button class="btn btn-link  btn-principal" type="button" data-toggle="collapse" data-target="#collapsePacientes" aria-expanded="true" aria-controls="collapsePacientes">
                <i class="far fa-user"></i>
                Dienst
            </button>
        </h2>
    </div>
    <div id="collapsePacientes" class="collapse show" aria-labelledby="pacientes" data-parent="#menuHome">
        <div class="card-body">
            <ul class="sub-menu">
                <li>
                    <a href="<?= $this->Url->build( strtolower($this->request->getParam('prefix')) . '/aspirantes/', ['fullBase' => true]); ?>" class="btn btn-link" data-togle="pill">Lista de aspirantes</a>
                </li>
                <li>
                    <a href="<?= $this->Url->build( strtolower($this->request->getParam('prefix')) . '/preocupacionales/asignarTurnoMasivo', ['fullBase' => true]); ?>" class="btn btn-link" data-togle="pill">Asignaci&oacute;n Grupal de turnos</a>
                </li>
                <li>
                    <a href="<?= $this->Url->build( strtolower($this->request->getParam('prefix')) . '/preocupacionales/sin-revisar', ['fullBase' => true]); ?>" class="btn btn-link" data-togle="pill">Lista de aspirantes a diagnosticar</a>
                </li>
            </ul>
        </div>
    </div>
</div>