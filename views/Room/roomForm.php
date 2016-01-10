<?php
$errors = $viewModel->get("errors");
$validationErrors = isset($errors['validationErrors']) ? $errors['validationErrors'] :false;
unset($errors['validationErrors']);
if ($errors) {
    foreach ($errors as $error) {
        echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
    }
}

$room = $viewModel->get("room");
$departments = $viewModel->get("departments");
$clients = $viewModel->get("clients");
?>

<form class="form-horizontal validate"
      action="<?php echo isset($room['id']) ? "/room/update/".$room['id'] : "/room/new/"; ?>" method="POST"
      enctype="multipart/form-data">
    <div class="modal-body">
        <input id="id" type="hidden" name="id" value="<?php echo $room['id']; ?>">

        <div class="form-group <?php echo isset($validationErrors['department_id']) ? "has-error" : false;?>">
            <label for="department_id" class="col-sm-2 control-label">Department</label>
            <div class="col-sm-10">
                <select id="department_id" class="form-control" name="department_id" >
                    <option value="">wähle ein Department aus</option>
                    <?php foreach ($departments as $department) {
                        $selected = (isset($room['department_id']) && $department['id'] === $room['department_id']) ? 'selected' : '';
                        echo "<option  value='".$department['id']."' ".$selected." >".$department['name']."</option>";
                    } ?>
                </select>
                <span class="help-block text-danger"><?php echo isset($validationErrors['department_id']) ? $validationErrors['department_id'] : false;?></span>
            </div>
        </div>
        <div class="form-group <?php echo isset($validationErrors['client_id']) ? "has-error" : false;?>">
            <label for="client_id" class="col-sm-2 control-label">Kunde</label>
            <div class="col-sm-10">
                <select id="client_id" class="form-control" name="client_id" >
                    <option value="">wähle einen Kunden aus</option>
                    <?php foreach ($clients as $client) {
                        $selected = (isset($room['client_id']) && $client['id'] === $room['client_id']) ? 'selected' : '';
                        echo "<option  value='".$client['id']."' ".$selected." >".$client['name']." ".$client['lastname']."</option>";
                    } ?>
                </select>
                <span class="help-block text-danger"><?php echo isset($validationErrors['client_id']) ? $validationErrors['client_id'] : false;?></span>
            </div>
        </div>
        <div class="form-group <?php echo isset($validationErrors['name']) ? "has-error" : false;?>">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="<?php echo $room['name']; ?>" id="name"
                       placeholder="der Raumname" >
                <span class="help-block text-danger"><?php echo isset($validationErrors['name']) ? $validationErrors['name'] : false;?></span>
            </div>
        </div>
        <div class="form-group <?php echo isset($validationErrors['title']) ? "has-error" : false;?>">
            <label for="title" class="col-sm-2 control-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="title" value="<?php echo $room['title']; ?>" id="title"
                       placeholder="der Raumtitle" >
                <span class="help-block text-danger"><?php echo isset($validationErrors['title']) ? $validationErrors['title'] : false;?></span>
            </div>
        </div>
        <div class="form-group <?php echo isset($validationErrors['description']) ? "has-error" : false;?>">
            <label for="description" class="col-sm-2 control-label">Beschreibung</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="description" id="description" placeholder="die Raumbeschreibung"><?php echo ($room['description']) ? $room['description'] : "Für ein gemütliches und wohnliches Zuhause: Mit diesem Stil können Sie garantiert nichts falsch machen. Sorgen Sie für ein schönes Ambiente in Ihrer Wohnung und lassen Sie Ihr Zuhause in einem neuen Look erstrahlen."; ?></textarea>
                <span class="help-block text-danger"><?php echo isset($validationErrors['description']) ? $validationErrors['description'] : false;?></span>
            </div>
        </div>
        <div class="form-group <?php echo isset($validationErrors['img']) ? "has-error" : false;?>">
            <label for="image" class="col-sm-2 control-label">Bild</label>
            <div class="col-sm-10">
                <div class="updated-img">
                <?php
                if (!empty($room['img'])) {
                    echo '<img src="/images/thumbnails/thumb_'.$room['img'].'" alt="'.$room['img'].'"/>';
                    echo '<input type="hidden" name="image" value="'.$room['img'].'">';
                }
                ?>
                </div>
                <input type="file" name="img" value="" id="img" placeholder="das Raumbild"
                       accept="image/*" <?php echo !empty($room['img']) ? "" : "required"; ?>>
                <span class="help-block text-danger"><?php echo isset($validationErrors['img']) ? $validationErrors['img'] : false;?></span>
            </div>
        </div>

        <div class="form-group <?php echo isset($validationErrors['slider']) ? "has-error" : false;?>">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="slider" value="1" id="slider" <?php echo ($room['slider']) ? "checked" : ""; ?>> im Slider zeigen
                        <span class="help-block text-danger"><?php echo isset($validationErrors['slider']) ? $validationErrors['slider'] : false;?></span>
                    </label>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
        <button type="submit" class="btn btn-corporate">Raum speichern</button>
    </div>
</form>