<form class="form-horizontal" role="form" method="post">

    <div class="form-group <? if (isset($verr['template_id'])) echo 'has-error'; ?>">
        <label for="fTemplate" class="col-sm-2 control-label">Szablon</label>
        <div class="col-sm-10">
            <select class="form-control" id="fTemplate" name="template_id">
                <option value='' selected>Wybierz szablon lub stwórz pismo własnoręcznie</option>
                <option >1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>
    </div>

    <div class="form-group <? if (isset($verr['to_dataset']) || isset($verr['to_id'])) echo 'has-error'; ?>">
        <label class="col-sm-2 control-label">Odbiorca</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="fToType" name="to_dataset" placeholder="Typ odbiorcy" value="<?= $doc['to_dataset'] ?>">
            <input type="number" class="form-control" id="fToId" name="to_id" placeholder="ID odbiorcy" value="<?= $doc['to_id'] ?>">
        </div>
    </div>

    <div class="form-group <? if (isset($verr['subject'])) echo 'has-error'; ?>">
        <label for="fTitle" class="col-sm-2 control-label">Tytuł</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="fTitle" name="subject" placeholder="Wpisz tytuł pisma" value="<?= $doc['subject'] ?>">
        </div>
    </div>

    <div class="form-group <? if (isset($verr['content'])) echo 'has-error'; ?>">
        <label for="fContent" class="col-sm-2 control-label">Treść</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="10" id="fContent" name="content"><?= $doc['content'] ?></textarea>
        </div>
    </div>

    <div class="form-group <? if (isset($verr['from_name']) || isset($verr['from_email'])) echo 'has-error'; ?>">
        <label class="col-sm-2 control-label">Nadawca</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="fFrom" name="from_name" value="<?= $doc['from_name'] ?>">
            <input type="email" class="form-control" id="fFromEmail" name="from_email" value="<?= $doc['from_email'] ?>">
        </div>
    </div>

    <!-- save et al. -->

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="fPublic"  value="<?= $doc['is_public'] ?>"> Upublicznij zapisano pismo
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save" class="btn btn-default">Zapisz</button>
            <button type="submit" name="saveAndSend" class="btn btn-default">Zapisz i wyślij</button>
        </div>
    </div>
</form>