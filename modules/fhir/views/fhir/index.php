<?php
$this->title = 'Pendaftaran';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="fhir-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
</div>



