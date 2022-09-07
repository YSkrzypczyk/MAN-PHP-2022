<form action="<?= $config["config"]["action"]??"" ?>"
      method="<?= $config["config"]["method"]??"GET" ?>"
      id="<?= $config["config"]["id"]??"" ?>"
      class="<?= $config["config"]["class"]??"" ?>">

    <?php foreach ( $config["inputs"] as $name=>$attrs) : ?>

        <div class="form-group">
            <input type="<?= $attrs["type"]??"text" ?>"
                   class="<?= $attrs["class"]??"" ?>"
                   id="<?= $attrs["id"]??"" ?>"
                   placeholder="<?= $attrs["placeholder"]??"" ?>"
                   <?= (isset($attrs["required"]))?'required="required"':'' ?>
            >
        </div>

    <?php endforeach;?>


    <input type="submit" value="<?= $config["config"]["submit"] ?>" class="btn btn-primary">

</form>