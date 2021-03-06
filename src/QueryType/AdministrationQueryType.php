<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class AdministrationQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'Administration',
            'fields' => function () use ($types) {
                return [
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'Administration Name',
                    ],
                    'accountName' => [
                        'type' => Type::string(),
                        'description' => 'Account Name',
                    ],
                    'currency' => [
                        'type' => $types->get(CurrencyQueryType::class),
                        'alias' => 'currencyId',
                        'link' => 'getById',
                        'description' => 'Currency',
                    ],
                    'description' => [
                        'type' => type::string(),
                        'description' => 'Description',
                        'resolve' => function ($value) {
                            return nl2br($value['description']);
                        },
                    ],
                    'createdAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Created at',
                    ],
                    'deletedAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Deleted at',
                    ],
                    'stripeKey' => [
                        'type' => Type::string(),
                        'description' => 'Strip Key',
                    ],
                    'stripeSyncType' => [
                        'type' => Type::string(),
                        'description' => 'Strip Sync Type',
                    ],
                    'turnoverGroups' => [
                        'type' => Type::listOf($types->get(TurnoverGroupQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Turnover Group',
                    ],
                    'turnoverGroupAccounts' => [
                        'type' => Type::listOf($types->get(TurnoverGroupAccountQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Turnover Group Account',
                    ],
                        'ledgerCategories' => [
                        'type' => Type::listOf($types->get(LedgerCategoryQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Ledger Category',
                    ],
                    'ledgerAccounts' => [
                        'type' => Type::listOf($types->get(LedgerAccountQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Ledger Account',
                    ],
                        'contacts' => [
                        'type' => Type::listOf($types->get(ContactQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of contact',
                    ],

                    'paymentMethods' => [
                        'type' => Type::listOf($types->get(PaymentMethodQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Payment Method',
                    ],
                    'journals' => [
                        'type' => Type::listOf($types->get(JournalQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Journal',
                     ],
                    'vat' => [
                        'type' => Type::listOf($types->get(VatQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of VAT',
                    ],
                    'chargeable' => [
                        'type' => Type::listOf($types->get(ChargeableQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Chargeable',
                    ],
                    'subscriptionPlan' => [
                        'type' => Type::listOf($types->get(SubscriptionPlanQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Subscription Plan',
                    ],
                    'batchs' => [
                        'type' => Type::listOf($types->get(BatchQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Batch',
                    ],
                    'subscriptions' => [
                        'type' => Type::listOf($types->get(SubscriptionQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Subscriptions',
                    ],
                    'invoices' => [
                        'type' => Type::listOf($types->get(InvoiceQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Invoice',
                    ],
                    'transactions' => [
                        'type' => Type::listOf($types->get(TransactionQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Trnasactions',
                    ],
                ];
            },
        ];
        parent::__construct($pdo, $config);
    }

    protected $tableName = 'administration';

    public function getByName($name)
    {
        return $this->getBy('name', $name);
    }
}
