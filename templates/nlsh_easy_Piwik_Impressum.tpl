<?php
$GLOBALS['TL_CSS']['nlsh_easy_Piwik_Counter'] = 'system/modules/nlsh_easy_Piwik_Counter/html/style.css';
?>
<!-- indexer::stop -->
<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<div class="piwik_impressum">

<?php  echo $this->piwikimpressum->impressumtext;
       echo $this->piwikimpressum->nopiwikmodul;
       if ($GLOBALS['TL_CONFIG']['piwiknoscan'] == false) echo $this->piwikimpressum->piwiknoscan; ?>
</div>
</div>
<!-- indexer::continue -->