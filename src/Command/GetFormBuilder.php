<?php namespace Anomaly\SubtotalDiscountConditionExtension\Command;

use Anomaly\ConfigurationModule\Configuration\Form\ConfigurationFormBuilder;
use Anomaly\DiscountsModule\Condition\Contract\ConditionInterface;
use Anomaly\DiscountsModule\Condition\Extension\ConditionExtension;
use Anomaly\DiscountsModule\Condition\Extension\Form\ConditionExtensionFormBuilder;
use Anomaly\DiscountsModule\Condition\Form\ConditionFormBuilder;
use Anomaly\DiscountsModule\Discount\Contract\DiscountInterface;


/**
 * Class GetFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\SubtotalDiscountConditionExtension\Command
 */
class GetFormBuilder
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
     * Create a new GetFormBuilder instance.
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
     * @param ConditionExtensionFormBuilder $builder
     * @param ConditionFormBuilder          $condition
     * @param ConfigurationFormBuilder      $configuration
     * @return ConditionExtensionFormBuilder
     */
    public function handle(
        ConditionExtensionFormBuilder $builder,
        ConditionFormBuilder $condition,
        ConfigurationFormBuilder $configuration
    ) {
        $builder->addForm(
            'condition',
            $condition
                ->setDiscount($this->discount)
                ->setExtension($this->extension)
                ->setEntry($this->condition ? $this->condition->getId() : null)
        );

        $builder->addForm(
            'configuration',
            $configuration
                ->setEntry('anomaly.extension.subtotal_discount_condition')
        );

        if ($this->condition) {
            $configuration->setScope($this->condition->getId());
        } else {
            $builder->on(
                'saved_condition',
                function () use ($condition, $configuration) {
                    $configuration->setScope(
                        $condition->getFormEntryId()
                    );
                }
            );
        }

        return $builder;
    }
}
