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
                    <a href="<?= $this->Url->build($redirect . 'aspirantes/', ['fullBase' => true]); ?>" class="btn btn-link" data-togle="pill">Lista de aspirantes</a>
                </li>
                <li>
                    <a href="<?= $this->Url->build($redirect . '/preocupacionales/asignarTurnoMasivo', ['fullBase' => true]); ?>" class="btn btn-link" data-togle="pill">Asignaci&oacute;n Grupal de turnos</a>
                </li>
                <li>
                    <a href="<?= $this->Url->build($redirect . '/preocupacionales/sin-revisar', ['fullBase' => true]); ?>" class="btn btn-link" data-togle="pill">Lista de presentes sin diagnosticar</a>
                </li>
            </ul>
        </div>
    </div>
</div>