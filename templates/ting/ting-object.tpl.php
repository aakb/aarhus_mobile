<?php
// $Id$
/**
 * @file ting_object.tpl.php
 *
 * Template to render objects from the Ting database.
 *
 * Available variables:
 * - $object: The TingClientObject instance we're rendering.
 * - $image: Image for the thing.
 * - $title: Main title.
 * - $other_titles: Also known as.
 * - $alternative_titles: Array of other alternative titles. May be empty;
 * - $creators: Authors of the item (string).
 * - $date: The date of the thing.
 * - $abstract: Short description.
 */
?>
<div id="ting-item-<?php print $object->localId; ?>" class="ting-item ting-item-full">

  <h1><?php print $title; ?></h1>
  
  <?php
    $titles = array();
    foreach (array_diff_key($object->record['dc:title'], array('' => 1)) as $type => $dc_title) {
      $titles = array_merge($titles, $dc_title);
    }
  ?>
  <?php if ($other_titles) { ?>
    <h2><?php print $other_titles; ?></h2>
  <?php } ?>
  <?php if ($alternative_titles) { ?>
    <?php foreach ($alternative_titles as $title) { ?>
      <h2>(<?php print check_plain($title); ?>)</h2>
    <?php } ?>
  <?php } ?>


  <?php if ($image) { ?>
  <div class="picture">
    <?php print $image; ?>
  </div>
  <?php } ?>
  
  <div class="right-of-pic clear-block">
    
    <div class='creator'>
      <span class='byline'><?php echo ucfirst(t('by')); ?></span>
      <?php print $creators; ?>
      <?php if ($date) { ?>
      <span class='date'>(<?php print $date; ?>)</span>
      <?php } ?>
    </div>
    <div class="abstract"><?php print implode(' ; ', format_danmarc2((array)$object->record['dcterms:abstract'][''])) ?></div>
            
    <?php print theme('item_list', array($object->type), t('Type'), 'ul', array('class' => 'type clear-block')); ?>
    <?php if (!empty($object->record['dc:format'][''])) { ?>
      <?php print theme('item_list', $object->record['dc:format'][''], t('Format'), 'ul', array('class' => 'format clear-block'));?>
    <?php } ?>
    <?php if (!empty($object->record['dcterms:isPartOf'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:isPartOf'][''], t('Available in'), 'ul', array('class' => 'is-part-of clear-block'));?>
    <?php } ?>


    <?php if (!empty($object->language)) { ?>
      <?php print theme('item_list', array($object->language), t('Language'), 'ul', array('class' => 'language'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:language']['oss:spoken'])) { ?>
      <?php print theme('item_list', $object->record['dc:language']['oss:spoken'], t('Speech'), 'ul', array('class' => 'language'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:language']['oss:subtitles'])) { ?>
      <?php print theme('item_list', $object->record['dc:language']['oss:subtitles'], t('Subtitles'), 'ul', array('class' => 'language'));?>
    <?php } ?>

    <?php if (!empty($object->record['dc:subject']['oss:genre'])) { ?>
      <?php print theme('item_list', $object->record['dc:subject']['oss:genre'], t('Genre'), 'ul', array('class' => 'subject'));?>
    <?php } ?>
    <?php if (!empty($object->subjects)) { ?>
      <?php print theme('item_list', $object->subjects, t('Subjects'), 'ul', array('class' => 'subject'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:subject']['dkdcplus:DK5'])) { ?>
      <?php print theme('item_list', $object->record['dc:subject']['dkdcplus:DK5'], t('Classification'), 'ul', array('class' => 'subject'));?>
    <?php } ?>
    <?php if (!empty($object->record['dcterms:spatial'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:spatial'][''], NULL, 'ul', array('class' => 'spatial')); ?>
    <?php } ?>

    <?php if (!empty($object->record['dc:contributor']['oss:dkind'])) { ?>
      <?php print theme('item_list', $object->record['dc:contributor']['oss:dkind'], t('Reader'), 'ul', array('class' => 'contributor'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:contributor']['oss:act'])) { ?>
      <?php print theme('item_list', $object->record['dc:contributor']['oss:act'], t('Actor'), 'ul', array('class' => 'contributor'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:contributor']['oss:mus'])) { ?>
      <?php print theme('item_list', $object->record['dc:contributor']['oss:mus'], t('Musician'), 'ul', array('class' => 'contributor'));?>
    <?php } ?>

    <?php if (!empty($object->record['dcterms:hasPart']['oss:track'])) { ?>
      <?php print theme('item_list', $object->record['dcterms:hasPart']['oss:track'], t('Contains'), 'ul', array('class' => 'contains'));?>
    <?php } ?>

    <?php if (!empty($object->record['dcterms:isReferencedBy'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:isReferencedBy'][''], t('Referenced by'), 'ul', array('class' => 'referenced-by'));?>
    <?php } ?>


    <?php if (!empty($object->record['dc:description'])) { ?>
      <?php foreach ($object->record['dc:description'] as $type => $dc_description) { ?>
        <?php print theme('item_list', $dc_description, t('Description'), 'ul', array('class' => 'description'));?>
      <?php } ?>
    <?php } ?>

    <?php if (!empty($object->record['dc:source'][''])) { ?>
      <?php print theme('item_list', $object->record['dc:source'][''], t('Original title'), 'ul', array('class' => 'titles'));?>
    <?php } ?>
    <?php if (!empty($object->record['dcterms:replaces'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:replaces'][''], t('Previous title'), 'ul', array('class' => 'titles'));?>
    <?php } ?>
    <?php if (!empty($object->record['dcterms:isReplacedBy'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:isReplacedBy'][''], t('Later title'), 'ul', array('class' => 'titles'));?>
    <?php } ?>

    <?php if (!empty($object->record['dc:identifier']['dkdcplus:ISBN'])) { ?>
      <?php print theme('item_list', $object->record['dc:identifier']['dkdcplus:ISBN'], t('ISBN no.'), 'ul', array('class' => 'identifier'));?>
    <?php } ?>

    <?php
    if (!empty($object->record['dc:identifier']['dcterms:URI'])) {
      $uris = array();
      foreach ($object->record['dc:identifier']['dcterms:URI'] as $uri) {
        $uris[] = l($uri, $uri);
      }
      print theme('item_list', $uris, t('Host publication'), 'ul', array('class' => 'identifier'));
    }
    ?>

    <?php if (!empty($object->record['dkdcplus:version'][''])) { ?>
      <?php print theme('item_list', $object->record['dkdcplus:version'][''], t('Version'), 'ul', array('class' => 'version'));?>
    <?php } ?>

    <?php if (!empty($object->record['dcterms:extent'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:extent'][''], t('Extent'), 'ul', array('class' => 'version'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:publisher'][''])) { ?>
      <?php print theme('item_list', $object->record['dc:publisher'][''], t('Publisher'), 'ul', array('class' => 'publisher'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:rights'][''])) { ?>
      <?php print theme('item_list', $object->record['dc:rights'][''], t('Rights'), 'ul', array('class' => 'rights'));?>
    <?php } ?>
    
    <div>

 <?php // TODO: This should be refactored into the availability module.
    if (ting_object_is($object, 'limited_availability')) { ?>
    <div class="ting-status waiting"><?php print t('waiting for data'); ?></div>
    <?php } ?>
    
     <?php if ($buttons) :?>
      <div class="ting-object-buttons">
      <?php print theme('item_list', $buttons, NULL, 'ul', array('class' => 'buttons')) ?>
      </div>
    <?php endif; ?>

</div>
    
    
  </div>


<?php /*
  <div class="ting-overview clearfix">
    <div class="left-column left">
      <div class="picture">
        <?php if ($image) { ?>
          <?php print $image; ?>
        <?php } ?>
      </div>

    </div>

    <div class="right-column left">
      <h1><?php print $title; ?></h1>
      <?php
      $titles = array();
      foreach (array_diff_key($object->record['dc:title'], array('' => 1)) as $type => $dc_title) {
        $titles = array_merge($titles, $dc_title);
      }
      ?>
      <?php if ($other_titles) { ?>
        <h2><?php print $other_titles; ?></h2>
      <?php } ?>
      <?php if ($alternative_titles) { ?>
        <?php foreach ($alternative_titles as $title) { ?>
          <h2>(<?php print check_plain($title); ?>)</h2>
        <?php } ?>
      <?php } ?>

      <div class='creator'>
        <span class='byline'><?php echo ucfirst(t('by')); ?></span>
        <?php print $creators; ?>
        <?php if ($date) { ?>
          <span class='date'>(<?php print $date; ?>)</span>
        <?php } ?>
      </div>
      <p><?php print $abstract; ?></p>
      <?php // TODO: This should be refactored into the availability module.
      if (ting_object_is($object, 'limited_availability')) { ?>
        <div class="ting-status waiting"><?php print t('waiting for data'); ?></div>
      <?php } ?>
    </div>

    <?php if ($buttons) :?>
      <div class="ting-object-buttons">
      <?php print theme('item_list', $buttons, NULL, 'ul', array('class' => 'buttons')) ?>
      </div>
    <?php endif; ?>

  </div>

  <div class="object-information clearfix">
    <?php
    //we printed the first part up above so remove that
    unset($object->record['dcterms:abstract'][''][0]);
    ?>
    <div class="abstract"><?php print implode(' ; ', format_danmarc2((array)$object->record['dcterms:abstract'][''])) ?></div>

    <?php print theme('item_list', array($object->type), t('Type'), 'ul', array('class' => 'type')); ?>
    <?php if (!empty($object->record['dc:format'][''])) { ?>
      <?php print theme('item_list', $object->record['dc:format'][''], t('Format'), 'ul', array('class' => 'format'));?>
    <?php } ?>
    <?php if (!empty($object->record['dcterms:isPartOf'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:isPartOf'][''], t('Available in'), 'ul', array('class' => 'is-part-of'));?>
    <?php } ?>


    <?php if (!empty($object->language)) { ?>
      <?php print theme('item_list', array($object->language), t('Language'), 'ul', array('class' => 'language'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:language']['oss:spoken'])) { ?>
      <?php print theme('item_list', $object->record['dc:language']['oss:spoken'], t('Speech'), 'ul', array('class' => 'language'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:language']['oss:subtitles'])) { ?>
      <?php print theme('item_list', $object->record['dc:language']['oss:subtitles'], t('Subtitles'), 'ul', array('class' => 'language'));?>
    <?php } ?>

    <?php if (!empty($object->record['dc:subject']['oss:genre'])) { ?>
      <?php print theme('item_list', $object->record['dc:subject']['oss:genre'], t('Genre'), 'ul', array('class' => 'subject'));?>
    <?php } ?>
    <?php if (!empty($object->subjects)) { ?>
      <?php print theme('item_list', $object->subjects, t('Subjects'), 'ul', array('class' => 'subject'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:subject']['dkdcplus:DK5'])) { ?>
      <?php print theme('item_list', $object->record['dc:subject']['dkdcplus:DK5'], t('Classification'), 'ul', array('class' => 'subject'));?>
    <?php } ?>
    <?php if (!empty($object->record['dcterms:spatial'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:spatial'][''], NULL, 'ul', array('class' => 'spatial')); ?>
    <?php } ?>

    <?php if (!empty($object->record['dc:contributor']['oss:dkind'])) { ?>
      <?php print theme('item_list', $object->record['dc:contributor']['oss:dkind'], t('Reader'), 'ul', array('class' => 'contributor'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:contributor']['oss:act'])) { ?>
      <?php print theme('item_list', $object->record['dc:contributor']['oss:act'], t('Actor'), 'ul', array('class' => 'contributor'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:contributor']['oss:mus'])) { ?>
      <?php print theme('item_list', $object->record['dc:contributor']['oss:mus'], t('Musician'), 'ul', array('class' => 'contributor'));?>
    <?php } ?>

    <?php if (!empty($object->record['dcterms:hasPart']['oss:track'])) { ?>
      <?php print theme('item_list', $object->record['dcterms:hasPart']['oss:track'], t('Contains'), 'ul', array('class' => 'contains'));?>
    <?php } ?>

    <?php if (!empty($object->record['dcterms:isReferencedBy'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:isReferencedBy'][''], t('Referenced by'), 'ul', array('class' => 'referenced-by'));?>
    <?php } ?>


    <?php if (!empty($object->record['dc:description'])) { ?>
      <?php foreach ($object->record['dc:description'] as $type => $dc_description) { ?>
        <?php print theme('item_list', $dc_description, t('Description'), 'ul', array('class' => 'description'));?>
      <?php } ?>
    <?php } ?>

    <?php if (!empty($object->record['dc:source'][''])) { ?>
      <?php print theme('item_list', $object->record['dc:source'][''], t('Original title'), 'ul', array('class' => 'titles'));?>
    <?php } ?>
    <?php if (!empty($object->record['dcterms:replaces'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:replaces'][''], t('Previous title'), 'ul', array('class' => 'titles'));?>
    <?php } ?>
    <?php if (!empty($object->record['dcterms:isReplacedBy'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:isReplacedBy'][''], t('Later title'), 'ul', array('class' => 'titles'));?>
    <?php } ?>

    <?php if (!empty($object->record['dc:identifier']['dkdcplus:ISBN'])) { ?>
      <?php print theme('item_list', $object->record['dc:identifier']['dkdcplus:ISBN'], t('ISBN no.'), 'ul', array('class' => 'identifier'));?>
    <?php } ?>

    <?php
    if (!empty($object->record['dc:identifier']['dcterms:URI'])) {
      $uris = array();
      foreach ($object->record['dc:identifier']['dcterms:URI'] as $uri) {
        $uris[] = l($uri, $uri);
      }
      print theme('item_list', $uris, t('Host publication'), 'ul', array('class' => 'identifier'));
    }
    ?>

    <?php if (!empty($object->record['dkdcplus:version'][''])) { ?>
      <?php print theme('item_list', $object->record['dkdcplus:version'][''], t('Version'), 'ul', array('class' => 'version'));?>
    <?php } ?>

    <?php if (!empty($object->record['dcterms:extent'][''])) { ?>
      <?php print theme('item_list', $object->record['dcterms:extent'][''], t('Extent'), 'ul', array('class' => 'version'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:publisher'][''])) { ?>
      <?php print theme('item_list', $object->record['dc:publisher'][''], t('Publisher'), 'ul', array('class' => 'publisher'));?>
    <?php } ?>
    <?php if (!empty($object->record['dc:rights'][''])) { ?>
      <?php print theme('item_list', $object->record['dc:rights'][''], t('Rights'), 'ul', array('class' => 'rights'));?>
    <?php } ?>
  </div>

  <?php
  $collection = ting_get_collection_by_id($object->id);
  if ($collection instanceof TingClientObjectCollection && is_array($collection->types)) {
    // Do we have more than only this one type?
    if (count($collection->types) > 1) {
      print '<div class="ding-box-wide object-otherversions">';
      print '<h3>'. t('Also available as: ') . '</h3>';
      print "<ul>";
      foreach ($collection->types as $type) {
        if ($type != $object->type) {
          $material_links[] = '<li class="category">' . l($type, $collection->url, array('fragment' => $type)). '</li>';
        }
      }
      print implode(' ', $material_links);
      print "</ul>";
      print "</div>";
    }
  }
  ?>

  <?php
    // TODO: This should be refactored into the availability module.
  if (ting_object_is($object, 'limited_availability')) { ?>
  <div class="ding-box-wide ting-availability">
    <h3>Følgende biblioteker har "<?php print check_plain($object->title); ?>" hjemme:</h3>
    <ul class="library-list">
      <li class="ting-status waiting even"><?php print t('waiting for data'); ?></li>
    </ul>
  </div>
  <?php } ?>
  
  */ ?>
</div>
