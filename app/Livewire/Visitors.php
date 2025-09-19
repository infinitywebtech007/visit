<?php

namespace App\Livewire;

use App\Models\Visitor;
use Livewire\Component;

class Visitors extends Component
{
    public $visitor_id = '';
    public $name = '';
    public $email = '';
    public $mobile = '';
    public $address = '';
    public $company_name = '';
    public $photo_url = '';
    public $id_proof = '';
    public $id_proof_img = '';
    public function render()
    {
        if (session()->has('last_visitor_id')) {
            $this->visitor_id = session('last_visitor_id');
            session()->forget('last_visitor_id');
        }
        $visitors = Visitor::all();
        return view('livewire.visitors', ['visitors' => $visitors]);
    }


    function save()
    {
        // $this->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:visitors,email',
        //     'mobile' => 'required|string|unique:visitors,mobile',
        //     'address' => 'required|string|max:255',
        //     'company_name' => 'required|string|max:255',
        //     'photo_url' => 'nullable|url|max:255',
        //     'id_proof' => 'nullable|string|max:255',
        //     'id_proof_img' => 'nullable|url|max:255',
        // ]);

        // dd($this->name, $this->email);
        $visitor = Visitor::create([
            'name' => $this->name ?? '' ,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'address' => $this->address,
            'company_name' => $this->company_name,
            'photo_url' => $this->photo_url,
            'id_proof' => $this->id_proof,
            'id_proof_img' => $this->id_proof_img,
        ]);
         $this->dispatch('visitor-added');
         $this->dispatch('show-toast', ['message'=>'Visitor created successfully.', 'type'=>'success']);

        // $this->visitor_id = $visitor->id;

        $this->reset(['name', 'email', 'mobile', 'address', 'company_name', 'photo_url', 'id_proof', 'id_proof_img']);
        // session(['last_visitor_id' => $visitor->id]);


        // Reset form fields


        
    }
}
