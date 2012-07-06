<?php
$GLOBALS['TL_CSS']['nlsh_easy_Piwik_Counter'] = 'system/modules/nlsh_easy_Piwik_Counter/html/style.css';
?>

<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>
<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif;?>
<!-- indexer::stop -->
<div class="piwik_counter">
<div class="visits_all">
<div class="visits_all_title"><?php echo $this->easyPiwikCounter['visits_all_title']; ?>
<span class="visits_all_number"><?php echo $this->easyPiwikCounter['visits_all']; ?></span>
</div>
</div>
<div class="visits_month">
<div class="visits_month_title"><?php echo $this->easyPiwikCounter['visits_month_title']; ?>
<span class="visits_month_number"><?php echo $this->easyPiwikCounter['visits_month']; ?></span>
</div>
</div>
<div class="visits_today">
<div class="visits_today_title"><?php echo $this->easyPiwikCounter['visits_today_title']; ?>
<span class="visits_today_number"><?php echo $this->easyPiwikCounter['visits_today']; ?></span>
</div>
</div>
<div class="visits_yesterday">
<div class="visits_yesterday_title"><?php echo $this->easyPiwikCounter['visits_yesterday_title']; ?>
<span class="visits_yesterday_number"><?php echo $this->easyPiwikCounter['visits_yesterday']; ?></span>
</div>
</div>
<div class="visits_online">
<div class="visits_online_title"><?php echo $this->easyPiwikCounter['visits_online_title']; ?>
<span class="visits_online_number"><?php echo $this->easyPiwikCounter['visits_online']; ?></span>
</div>
</div>
</div>
</div>
<!-- indexer::continue -->   