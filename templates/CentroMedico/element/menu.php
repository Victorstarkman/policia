<div class="card">
    <div class="card-header" id="pacientes">
        <h2 class="mb-0">
            <button class="btn btn-link  btn-principal" type="button" data-toggle="collapse" data-target="#collapsePacientes" aria-expanded="true" aria-controls="collapsePacientes">
                <i class="far fa-user"></i>
                Centro médico
            </button>
        </h2>
    </div>
    <div id="collapsePacientes" class="collapse show" aria-labelledby="pacientes" data-parent="#menuHome">
        <div class="card-body">
            <ul class="sub-menu">
                <li>
                    <a href="<?= $this->Url->build(  DS . 'centro-medico/', ['fullBase' => true]); ?>" class="btn btn-link" data-togle="pill">Preocupacionales de hoy</a>

                <li>
                    <a href="<?= $this->Url->build(  DS . 'centro-medico/preocupacionales/sin-finalizar', ['fullBase' => true]); ?>" class="btn btn-link" data-togle="pill">Lista de presentes con falta de documentación.</a>
                </li>
            </ul>
        </div>
    </div>
</div>