<?php

App::uses('Sanitize', 'Utility');

class KodyPocztoweController extends KodyPocztoweAppController
{
    public $uses = array('KodyPocztowe.KodPocztowy', 'Dane.Dataobject');
    public $components = array('Session', 'Paginator');

    public function index()
    {
        $details = false;
        $mstr = @$this->request->query['mstr'];
        $mid = @$this->request->query['mid'];
        $kod = @$this->request->query['kod'];

        $this->set('mstr', $mstr);
        $this->set('mid', $mid);
        $this->set('kod', $kod);

        if ($kod) {
            $code = $this->API->searchCode($kod);
            if ($code && $code['Code'] && $code['Code']['id']) {
                $this->redirect(array('plugin' => 'Dane', 'controller' => 'kody_pocztowe', 'action' => 'view', 'id' => $code['Code']['id']));
            } else {
                $this->Session->setFlash('Podany kod pocztowy nie zostały odnaleziony');
            }
        } elseif ($mid) {

            $details = true;
            $miejscowosc = $this->API->Dane()->getObject('miejscowosci', $mid);
            $this->set('miejscowosc', $miejscowosc->getData());

            $ustr = @$this->request->query['ustr'];
            $this->set('ustr', $ustr);

            if ($miejscowosc) {
                $this->addStatusbarCrumb(array(
                    'text' => $miejscowosc->getData('nazwa'),
                ));
                $adresy = $this->API->searchAddresses($miejscowosc->getId(), $ustr);
                $this->set('adresy', $adresy);
            }


        } elseif ($mstr) {
            $details = true;
            $this->paginate = array(
                'conditions' => array(
                    'dataset' => 'miejscowosci',
                    'q' => Sanitize::stripAll($mstr),
                ),
                'paramType' => 'querystring',
            );
            $miejscowosci = $this->Paginator->paginate('Dataobject');
            $pagination = $this->Dataobject->pagination;
            $total = $this->Dataobject->total;
            if (!$total) {
                $this->Session->setFlash('Podana miejscowość nie została odnaleziona');
            } elseif ($total === 1 && ($mid = $miejscowosci[0]['Dataobject']->object_id)) {
                $this->redirect('/kody_pocztowe?mstr=' . $mstr . '&mid=' . $mid);
            } else {
                $this->set('miejscowosci', $miejscowosci);
            }
            $this->set(compact('pagination', 'total'));
        }

        $this->set('details', $details);

        $application = $this->getApplication();
        $this->set('title_for_layout', $application['Application']['name']);

    }


} 