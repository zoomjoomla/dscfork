<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php $state = @$this->state; ?>
<?php $form = @$this->form; ?>
<?php $items = @$this->items; ?>
<?php 
JHTML::_('behavior.modal');
JHTML::_('behavior.tooltip');
$model = $this->getModel();
$keyname = $model->getTable()->getKeyName();
$title_key = $model->get('title_key');
$javascript = 'onchange="document.adminForm.submit();"';
?>

<form action="<?php echo JRoute::_( @$form['action'] .'&tmpl=component&object='.$this->object )?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

    <table>
        <tr>
            <td align="left" width="100%">
            </td>
            <td nowrap="nowrap">
                <input  type="text" name="filter" value="<?php echo @$state->filter; ?>" />
                <button class="btn btn-primary" onclick="this.form.submit();"><?php echo JText::_('LIB_DSCFORK_SEARCH'); ?></button>
                <button class="btn btn-danger" onclick="dscfork.formReset(this.form);"><?php echo JText::_('LIB_DSCFORK_RESET'); ?></button>
            </td>
        </tr>
    </table>

    <table class="table table-striped table-bordered" cellspacing="1">
        <thead>
            <tr>
                <th style="width: 5px;">
                    <?php echo JText::_("Num"); ?>
                </th>
                <th style="width: 50px;">
                    <?php echo DSCForkGrid::sort( 'ID', "tbl." . $keyname, @$state->direction, @$state->order ); ?>
                </th>
                <th style="text-align: left;">
                    <?php echo DSCForkGrid::sort( ucfirst($title_key), "tbl." . $title_key, @$state->direction, @$state->order ); ?>
                </th>
            </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="15">
                <?php echo $this->pagination->getListFooter(); ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <?php $i = 1; ?>
        <?php foreach (@$items as $item) : ?>
            <tr>
                <td style="text-align: center;"><?php echo $i++; ?></td>
                <td style="text-align: center;">
                    <a style="cursor: pointer;" onclick="window.parent.dscfork.select<?php echo $model->getName(); ?>('<?php echo $item->$keyname; ?>', '<?php echo str_replace(array("'", "\""), array("\\'", ""), $item->$title_key); ?>', '<?php echo $this->object; ?>');">
                        <?php echo $item->$keyname; ?>
                    </a>
                </td>
                <td style="text-align: left;">
                    <a style="cursor: pointer;" onclick="window.parent.dscfork.select<?php echo $model->getName(); ?>('<?php echo $item->$keyname; ?>', '<?php echo str_replace(array("'", "\""), array("\\'", ""), $item->$title_key); ?>', '<?php echo $this->object; ?>');">
                        <?php echo $item->$title_key; ?>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            
            <?php if (!count(@$items)) : ?>
            <tr>
                <td colspan="10" align="center">
                    <?php echo JText::_('LIB_DSCFORK_NO_ITEMS_FOUND'); ?>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <input type="hidden" name="order_change" value="0" />
    <input type="hidden" name="id" value="" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="" />
    <input type="hidden" name="filter_order" value="<?php echo @$state->order; ?>" />
    <input type="hidden" name="filter_direction" value="<?php echo @$state->direction; ?>" />
    
</form>