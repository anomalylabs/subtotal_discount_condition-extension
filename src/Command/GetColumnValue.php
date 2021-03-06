<?php namespace Anomaly\SubtotalDiscountConditionExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DiscountsModule\Condition\Contract\ConditionInterface;
use Anomaly\DiscountsModule\Condition\Extension\ConditionExtension;
use Anomaly\DiscountsModule\Discount\Contract\DiscountInterface;
use Illuminate\Translation\Translator;

/**
 * Class GetColumnValue
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\SubtotalDiscountConditionExtension\Command
 */
class GetColumnValue
{

    /**
     * The discount interface.
     *
     * @var DiscountInterface
     */
    protected $discount;

    /**
     * The condition interface.
     *
     * @var ConditionInterface
     */
    protected $condition;

    /**
     * The condition extension.
     *
     * @var ConditionExtension
     */
    protected $extension;

    /**
     * Create a new GetColumnValue instance.
     *
     * @param ConditionExtension $extension
     * @param DiscountInterface  $discount
     * @param ConditionInterface $condition
     */
    public function __construct(
        ConditionExtension $extension,
        DiscountInterface $discount,
        ConditionInterface $condition = null
    ) {
        $this->discount  = $discount;
        $this->condition = $condition;
        $this->extension = $extension;
    }

    /**
     * Handle the command.
     *
     * @return string
     */
    public function handle(Translator $translator, ConfigurationRepositoryInterface $configuration)
    {
        $scope = $this->condition->getId();

        $operator = $configuration->presenter('anomaly.extension.subtotal_discount_condition::operator', $scope)->value;
        $value    = $configuration->presenter('anomaly.extension.subtotal_discount_condition::value', $scope)->currency;

        return $translator->trans(
            'anomaly.extension.subtotal_discount_condition::message.condition',
            compact('operator', 'value')
        );
    }
}
