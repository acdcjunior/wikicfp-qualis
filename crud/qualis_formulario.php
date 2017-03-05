<?php

function qualisFormulario($tituloFormulario, $labelBotaoEnviar, $row)
{
    ?>
    <div class="container">
        <div class="row">
            <h1><?= $tituloFormulario ?></h1>
        </div>
        <div class="row">
            <form action='' method='POST' class="col s12" onsubmit="btnSubmit.disabled = true">

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" class="validate" id="titulo" name='titulo' required
                               value='<?= stripslashes($row['titulo']) ?>'><label for="titulo">Título (Ex.: IEEE
                            TRANSACTIONS ON SOFTWARE ENGINEERING)</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" class="validate" id="sigla" name='sigla'
                               value='<?= stripslashes($row['sigla']) ?>'><label for="sigla">Sigla do Evento (Ex.:
                            BRCOM, IEEE-ICDDM, etc.)</label>
                    </div>
                </div>

                <div class="row">
                    <label>Classificação (Estrato) Qualis do Evento</label>
                    <select id="qualis" name='qualis' required class="browser-default">
                        <option value="" disabled selected>Selecione a classificação Qualis deste evento</option>
                        <option <?= ($row['qualis'] == 'C') ? 'selected' : '' ?>>C
                        <option <?= ($row['qualis'] == 'B5') ? 'selected' : '' ?>>B5
                        <option <?= ($row['qualis'] == 'B4') ? 'selected' : '' ?>>B4
                        <option <?= ($row['qualis'] == 'B3') ? 'selected' : '' ?>>B3
                        <option <?= ($row['qualis'] == 'B2') ? 'selected' : '' ?>>B2
                        <option <?= ($row['qualis'] == 'B1') ? 'selected' : '' ?>>B1
                        <option <?= ($row['qualis'] == 'A2') ? 'selected' : '' ?>>A2
                        <option <?= ($row['qualis'] == 'A1') ? 'selected' : '' ?>>A1
                    </select>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" class="validate" id="issn" name='issn'
                               value='<?= stripslashes($row['issn']) ?>'><label for="issn">ISSN (Ex.: 0098-5589)</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" class="validate" id="area_avaliacao" name='area_avaliacao'
                               value='<?= stripslashes($row['area_avaliacao']) ?>'><label for="area_avaliacao">Área de
                            Avaliação (Ex.: CIÊNCIA DA COMPUTAÇÃO)</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <input type="text" class="validate" id="fonte" name='fonte' required
                               value='<?= stripslashes($row['fonte']) ?>'><label for="fonte">Onde esse valor de Qualis
                            foi obtido? (Ex.: site oficial, google, outros.)</label>
                    </div>
                </div>

                <div class="row">
                    <input type='hidden' value='1' name='submitted'/>
                    <button class="btn waves-effect waves-light" type="submit" name="action"
                            id="btnSubmit"><?= $labelBotaoEnviar ?>
                        <i class="material-icons right">send</i>
                    </button>
                    <a class="btn waves-effect waves-light grey lighten-5" style='color: black'
                       href='qualis_list.php'><i class="material-icons right">undo</i>Voltar para listagem</a>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        /* global $ */
        $(document).ready(function () {
            $('#qualis').material_select();
        });
    </script>
<?php
}
