<?php

namespace App\Livewire;

use App\Models\Visitor;
use Livewire\Component;
use Illuminate\Http\Request;

class Visitors extends Component
{
    public $visitor_id = '';
    public $search = '';
    public $showDropdown = false;
    public $selectedVisitorName = '';
    
    // Form fields for adding new visitor
    public $name = '';
    public $email = '';
    public $mobile = '';
    public $address = '';
    public $company_name = '';
    public $photo_url = '';
    public $id_proof = '';
    public $id_proof_img = '';

    public function mount()
    {
        if (session()->has('last_visitor_id')) {
            $this->visitor_id = session('last_visitor_id');
            $this->setSelectedVisitorName();
            session()->forget('last_visitor_id');
        }
    }

    public function render()
    {
        // Only get filtered visitors when actually needed
        $filteredVisitors = ($this->showDropdown && strlen($this->search) >= 3) 
            ? $this->getFilteredVisitors() 
            : collect();
        
        return view('livewire.visitors', [
            'filteredVisitors' => $filteredVisitors
        ]);
    }

    public function getFilteredVisitors()
    {
        if (empty($this->search) || strlen($this->search) < 3) {
            return collect(); // Search when 3+ characters (mobile numbers)
        }

        // Search only by mobile - much faster!
        return Visitor::select('id', 'name', 'mobile', 'company_name')
            ->where('mobile', 'LIKE', $this->search . '%') // Starts with search term
            ->limit(8)
            ->get();
    }

    public function selectVisitor($visitorId)
    {
        $visitor = Visitor::find($visitorId);
        if ($visitor) {
            $this->visitor_id = $visitorId;
            $this->selectedVisitorName = $visitor->name;
            $this->search = $visitor->name;
            $this->showDropdown = false;
        }
    }

    public function showDropdown()
    {
        $this->showDropdown = true;
    }

    public function hideDropdown()
    {
        // Add a small delay to allow click events on dropdown items
        $this->dispatch('hide-dropdown-delayed');
    }

    public function clearSelection()
    {
        $this->visitor_id = '';
        $this->selectedVisitorName = '';
        $this->search = '';
        $this->showDropdown = false;
    }

    private function setSelectedVisitorName()
    {
        if ($this->visitor_id) {
            $visitor = Visitor::find($this->visitor_id);
            if ($visitor) {
                $this->selectedVisitorName = $visitor->name;
                $this->search = $visitor->name;
            }
        }
    }

    public function updatedSearch()
    {
        // Only process if search has meaningful length
        if (strlen($this->search) < 3) {
            $this->showDropdown = false;
            if (empty($this->search)) {
                $this->clearSelection();
            }
            return;
        }

        $this->showDropdown = true;
        
        // Clear selection if search doesn't match selected visitor
        if ($this->selectedVisitorName && $this->search !== $this->selectedVisitorName) {
            $this->visitor_id = '';
            $this->selectedVisitorName = '';
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:visitors,email' . ($this->visitor_id ? ',' . $this->visitor_id : ''),
            'mobile' => 'required|string|unique:visitors,mobile' . ($this->visitor_id ? ',' . $this->visitor_id : ''),
            'address' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'photo_url' => 'nullable|url|max:255',
            'id_proof' => 'nullable|string|max:255',
            'id_proof_img' => 'nullable|url|max:255',
        ]);

        $visitor = Visitor::create([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'address' => $this->address,
            'company_name' => $this->company_name,
            'photo_url' => $this->photo_url,
            'id_proof' => $this->id_proof,
            'id_proof_img' => $this->id_proof_img,
        ]);
}
}