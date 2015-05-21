<?php
namespace App\Model\Table;

use App\Model\Entity\HedgePosition;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HedgePositions Model
 */
class HedgePositionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->table('hedge_positions');
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
            ->allowEmpty('bias');
            
        $validator
            ->add('amount', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('amount');
            
        $validator
            ->add('ssp', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('ssp');
            
        $validator
            ->allowEmpty('leverage');
            
        $validator
            ->add('balance', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('balance');
            
        $validator
            ->add('openprice', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('openprice');
            
        $validator
            ->add('closeprice', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('closeprice');
            
        $validator
            ->add('timeopened', 'valid', ['rule' => 'datetime'])
            ->allowEmpty('timeopened');
            
        $validator
            ->add('recalculation', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('recalculation');
            
        $validator
            ->add('status', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('status');

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
