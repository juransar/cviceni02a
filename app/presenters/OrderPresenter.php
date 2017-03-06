<?php

namespace App\Presenters;

use App\Model\OrderModel;
use App\Model\UserModel;
use App\Forms\OrderFormFactory;
use Nette\Application\UI\Form;
use App\Model\NoDataFound;
use Tracy\Debugger;



class OrderPresenter extends BasePresenter
{
    /** @var OrderFormFactory - Formulářová továrnička pro správu nákupů */
    private $formFactory;

    /** @var OrderModel - model pro management nákupů */
    private $orderModel;

    /** @var UserModel - model pro management uživatelů*/
    private $userModel;

    /**
     * Setter pro formulářovou továrničku a modely správy uživatelů a nákupů.
     * @param UserFormFactory $formFactory automaticky injectovaná formulářová továrnička pro správu nákupů
     * @param OrderModel $orderModel automatiky injetovaný model pro správu nákupů
     * @param UserModel $userModel automatiky injetovaný model pro správu uživatelů
     */
    public function injectDependencies(
        OrderFormFactory $formFactory,
        OrderModel $orderModel,
        UserModel $userModel
    )
    {
        $this->formFactory = $formFactory;
        $this->orderModel = $orderModel;
        $this->userModel = $userModel;
    }

    /**
     * Akce pro vkádání
     */
    public function actionAdd() {
        $form = $this['addForm'];
        //$users=$this->userModel->listUsers();
        //$form->setDefaults(['user'=>$users]);
        /** TODO naplnění dat do vkládáacího formuláře */
        $users=$this->userModel->listUsers();
        $u=[];
        foreach ($users as $user)
           $u[$user->id]=$user->surname." ".$user->firstname;
        $form['user_id']->setItems($u);
    }

    /**
     * Akce pro editaci
     * @param int $id id uživatele
     */
    public function actionEdit($id) {
        $form = $this['editForm'];
        /** TODO naplnění dat do editačního formuláře */
        $order=$this->orderModel->getOrder($id);
        $form->setDefaults($order);

    }

    /**
     * Akce pro mazání
     * @param int $id id uživatele
     */
    public function actionDelete($id) {
        $form = $this['deleteForm'];
        /** TODO naplnění dat do editačního formuláře */

    }

    /**
     * Metoda pro vytvoření formuáře pro vložení
     * @return Form - formulář
     */
    public function createComponentAddForm()
    {
        $form = $this->formFactory->createAddForm();
        $form->onSuccess[] = function (Form $form) {
            $this->redirect('Order:default');
        };
        return $form;
    }

    /**
     * Metoda pro vytvoření formuáře pro editaci
     * @return Form - formulář
     */
    public function createComponentEditForm()
    {
        $form = $this->formFactory->createEditForm();
        $form->onSuccess[] = function (Form $form) {
            $this->redirect('Order:default');
        };
        return $form;
    }

    /**
     * Metoda pro vytvoření formuáře pro mazání
     * @return Form - formulář
     */
    public function createComponentDeleteForm()
    {
        $form = $this->formFactory->createDeleteForm();
        $form->onSuccess[] = function (Form $form) {
            $this->redirect('Order:default');
        };
        return $form;
    }

    /**
     * Metoda pro naplnění dat pro šablonu dané akce
     */
    public function renderEdit($id) {
        /** TODO - nastavení atributu šablony name */
        $u_id=$this->orderModel->getOrder($id)->user_id;
        $this->template->name=$this->userModel->getUser($u_id)->surname;

    }

    /**
     * Metoda pro naplnění dat pro šablonu dané akce
     */
    public function renderDelete($id) {
        /** TODO - nastavení atributu šablony name */
        $u_id=$this->orderModel->getOrder($id)->user_id;
        $this->template->name=$this->userModel->getUser($u_id)->surname;
    }

    /**
     * Metoda pro naplnění dat pro šablonu dané akce
     */
    public function renderDefault() {
        /** TODO - nastavení atributu šablony orders */
        $this->template->orders=$this->orderModel->listOrders();

    }
}
