<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class SurveysController extends AppController
{
    /**
     * Ask method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function ask()
    {
        $heAsk = false;
        $this->loadModel('Users');
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $score = 0;
            $responses = [
                'question_0' => false,
                'question_1' => true,
                'question_2' => false,
                'question_3' => false,
                'question_4' => true,
                'question_5' => false,
                'question_6' => false,
                'question_7' => false,
                'question_8' => true,
                'question_9' => false,
            ];

            foreach ($responses as $key => $value) {
                if ($this->request->data[$key] == $value) {
                    $score++;
                }
                //unset($this->request->data[$key]);

            }
            $this->request->data['score'] = $score;
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                // $this->Flash->success(__('Votre participation est prise en compte'));
                //return $this->redirect(['action' => 'index', $user->id ]);

                $heAsk = true;


            } else {
                //$this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('heAsk'));
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

}
