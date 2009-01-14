<?php echo form_tag('#', array("id"=>"disegni-decreti-filter")) ?>
  <fieldset class="labels">
    <label for="topic">argomento:</label>
    <label for="type">iniziativa:</label>
    <label for="room">ramo:</label>
    <label for="status">stato:</label>
  </fieldset>
  <p>filtra per</p>
  <fieldset>
    <select id="topic" name="topic">
      <option value="0" selected="selected">tutti</option>
      <option value="1">1. lorem ipsum lorem ipsum lorem ipsum lorem ipsum lorem ipsum</option>
      <option value="2">2. lorem ipsum</option>
    </select>
    <select id="type" name="type">
      <option value="0" selected="selected">tutte</option>
      <option value="1">1. lorem ipsum</option>
      <option value="2">2. lorem ipsum</option>
    </select>
    <select id="room" name="room">
      <option value="0" selected="selected">tutti</option>
      <option value="1">1. lorem ipsum</option>
      <option value="2">2. lorem ipsum</option>
    </select>
    <select id="status" name="status">
      <option value="0" selected="selected">tutti</option>
      <option value="1">in corso</option>
      <option value="2">approvato</option>
      <option value="3">respinto</option>
      <option value="4">tutti i conclusi</option>								
    </select>
    <?php echo submit_image_tag('btn-applica.png', array('id' => 'disegni-decreti-filter-apply', 'alt' => 'applica', 'style' => 'display: none;', 'name' => 'disegni-decreti-filter-apply' )) ?>
  </fieldset>
</form>