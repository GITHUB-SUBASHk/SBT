<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Profile;

class Profiles extends Component
{
    public $name, $email, $designation, $profileId;
    public $isEdit = false;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:profiles,email',
        'designation' => 'nullable'
    ];

    public function render()
    {
        return view('livewire.profiles', [
            'profiles' => Profile::all()
        ]);
    }

    public function resetForm()
    {
        $this->name = $this->email = $this->designation = '';
        $this->profileId = null;
        $this->isEdit = false;
    }

    public function save()
    {
        $validated = $this->validate();

        Profile::create($validated);

        session()->flash('message', 'Profile added.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        $this->profileId = $profile->id;
        $this->name = $profile->name;
        $this->email = $profile->email;
        $this->designation = $profile->designation;
        $this->isEdit = true;
    }

    public function update()
    {
        $profile = Profile::findOrFail($this->profileId);

        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:profiles,email,' . $profile->id,
            'designation' => 'nullable'
        ]);

        $profile->update([
            'name' => $this->name,
            'email' => $this->email,
            'designation' => $this->designation,
        ]);

        session()->flash('message', 'Profile updated.');
        $this->resetForm();
    }

    public function delete($id)
    {
        Profile::find($id)->delete();
        session()->flash('message', 'Profile deleted.');
    }
}
?>