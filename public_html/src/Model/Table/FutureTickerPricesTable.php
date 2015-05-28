<?php
namespace App\Model\Table;

use App\Model\Entity\FutureTickerPrice;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FutureTickerPrices Model
 */
class FutureTickerPricesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('future_ticker_prices');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->belongsTo('Exchanges', [
            'foreignKey' => 'exchange_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');
            
        $validator
            ->allowEmpty('timestamp');
            
        $validator
            ->add('last', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('last');
            
        $validator
            ->add('buy', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('buy');
            
        $validator
            ->add('sell', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('sell');
            
        $validator
            ->add('high', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('high');
            
        $validator
            ->add('low', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('low');
            
        $validator
            ->add('volume', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('volume');
            
        $validator
            ->add('contract', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('contract');
            
        $validator
            ->allowEmpty('contract_type');
            
        $validator
            ->add('unit_amount', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('unit_amount');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['exchange_id'], 'Exchanges'));
        return $rules;
    }
}
