<?php
    $method = $config["config"]["method"]??"GET";
?>
<form action="<?= $config["config"]["action"]??"" ?>"
      method="<?= $method ?>"
      id="<?= $config["config"]["id"]??"" ?>"
      class="<?= $config["config"]["class"]??"" ?>">

    <?php foreach ( $config["inputs"] as $name=>$attrs) : ?>

        <div class="form-group">

            <input name="<?= $name ?>"
                    type="<?= $attrs["type"]??"text" ?>"
                   class="<?= $attrs["class"]??"" ?>"
                   id="<?= $attrs["id"]??"" ?>"
                   placeholder="<?= $attrs["placeholder"]??"" ?>"
                   <?= (isset($attrs["required"]))?'required="required"':'' ?>
                    value="<?= ($attrs["type"] != "password")?($_REQUEST[$name]??""):"" ?>"
            >

            <?php if (!empty($errors[$name] )):?>
                <div class="text text-danger ">- <?= $errors[$name] ?></div>
            <?php endif;?>

        </div>

    <?php endforeach;?>


    <input type="submit" value="<?= $config["config"]["submit"] ?>" class="btn btn-primary">

</form>