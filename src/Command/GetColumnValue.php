<?php namespace Anomaly\SubtotalDiscountConditionExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\StoreModule\Condition\Contract\ConditionInterface;
use Anomaly\StoreModule\Condition\Extension\Contract\ConditionExtensionInterface;
use Anomaly\StoreModule\Discount\Contract\DiscountInterface;
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
     * @var ConditionExtensionInterface
     */
    protected $extension;

    /**
     * Create a new GetColumnValue instance.
     *
     * @param ConditionExtensionInterface $extension
     * @param DiscountInterface           $discount
     * @param ConditionInterface          $condition
     */
    public function __construct(
        ConditionExtensionInterface $extension,
        DiscountInterface $discount,
        ConditionInterface $condition = null
    ) {
        $this->discount = $discount;
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
        $scope = 'discount_' . $this->discount->getId() . '_' . $this->condition->getId();

        $operator = $configuration->presenter('anomaly.extension.subtotal_discount_condition::operator', $scope)->value;
        $value    = $configuration->presenter('anomaly.extension.subtotal_discount_condition::value', $scope)->currency;

        return $translator->trans(
            'anomaly.extension.subtotal_discount_condition::message.condition',
            compact('operator', 'value')
        );
    }
}
