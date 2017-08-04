<?php namespace Anomaly\SubtotalDiscountConditionExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationRepositoryInterface;
use Anomaly\DiscountsModule\Condition\Contract\ConditionInterface;

/**
 * Class GetConditionValue
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetConditionValue
{

    /**
     * The condition instance.
     *
     * @var ConditionInterface
     */
    protected $condition;

    /**
     * Create a new GetConditionValue instance.
     *
     * @param ConditionInterface $condition
     */
    public function __construct(ConditionInterface $condition)
    {
        $this->condition = $condition;
    }

    /**
     * Handle the command.
     *
     * @param ConfigurationRepositoryInterface $configuration
     * @return float
     */
    public function handle(ConfigurationRepositoryInterface $configuration)
    {
        return $configuration->value(
            'anomaly.extension.subtotal_discount_condition::value',
            $this->condition->getId()
        );
    }
}
