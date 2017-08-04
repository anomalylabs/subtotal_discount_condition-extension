<?php namespace Anomaly\SubtotalDiscountConditionExtension;

use Anomaly\DiscountsModule\Condition\Contract\ConditionInterface;
use Anomaly\DiscountsModule\Condition\Extension\ConditionExtension;
use Anomaly\DiscountsModule\Condition\Extension\Form\ConditionExtensionFormBuilder;
use Anomaly\DiscountsModule\Discount\Contract\DiscountInterface;
use Anomaly\SubtotalDiscountConditionExtension\Command\GetColumnValue;
use Anomaly\SubtotalDiscountConditionExtension\Command\GetFormBuilder;

/**
 * Class SubtotalDiscountConditionExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\SubtotalDiscountConditionExtension
 */
class SubtotalDiscountConditionExtension extends ConditionExtension
{

    /**
     * This extension provides the subtotal
     * condition for the discounts module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.discounts::condition.subtotal';

    /**
     * Return the form builder.
     *
     * @param DiscountInterface  $discount
     * @param ConditionInterface $condition
     * @return ConditionExtensionFormBuilder
     */
    public function form(DiscountInterface $discount, ConditionInterface $condition = null)
    {
        return $this->dispatch(new GetFormBuilder($this, $discount, $condition));
    }

    /**
     * Return the column value for the table.
     *
     * @param DiscountInterface  $discount
     * @param ConditionInterface $condition
     * @return string
     */
    public function column(DiscountInterface $discount, ConditionInterface $condition)
    {
        return $this->dispatch(new GetColumnValue($this, $discount, $condition));
    }
}
