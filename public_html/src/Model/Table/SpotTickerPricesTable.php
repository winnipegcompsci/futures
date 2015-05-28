<?php
namespace App\Model\Table;

use App\Model\Entity\SpotTickerPrice;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SpotTickerPrices Model
 */
class SpotTickerPricesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('spot_ticker_prices');
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
            ->add('buy', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('buy');
            
        $validator
            ->add('high', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('high');
            
        $validator
            ->add('last', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('last');
            
        $validator
            ->add('low', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('low');
            
        $validator
            ->add('sell', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('sell');
            
        $validator
            ->add('vol', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('vol');

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
