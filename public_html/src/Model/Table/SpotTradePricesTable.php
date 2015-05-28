<?php
namespace App\Model\Table;

use App\Model\Entity\SpotTradePrice;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SpotTradePrices Model
 */
class SpotTradePricesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('spot_trade_prices');
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
            ->add('price', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('price');
            
        $validator
            ->add('amount', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('amount');
            
        $validator
            ->add('tid', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('tid');
            
        $validator
            ->allowEmpty('type');

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
