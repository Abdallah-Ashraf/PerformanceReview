<?php

namespace App\Http\Livewire;

use App\Repository\PerformanceReviewRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class PerformanceReviews extends Component
{

    use WithPagination;

    public $review =[
        'name'=>'',
        'description'=>'',
        'reviewer_id'=>'',
        'reviewee'=>[],
    ];
    public $action = 'saveReview';
    public $reviewId;



    protected $validationAttributes = [
        'review.name' => 'Name',
        'review.description' => 'Description',
        'review.reviewer_id' => 'Reviewer',
        'review.reviewee' => 'Reviewee'
    ];



    public function saveReview(PerformanceReviewRepositoryInterface $reviewRepository){
        $this->validate();
        $review = $reviewRepository->create($this->review);
        $this->review =[
            'name'=>'',
            'description'=>'',
            'reviewer_id'=>'',
            'reviewee'=>[],
        ];
        session()->flash('message', 'Performance Review Data Saved successfully.');

    }


    public function editReview(PerformanceReviewRepositoryInterface $reviewRepository,$id){
        $review=$reviewRepository->find($id);
        $this->reviewId = $id;
        $this->review['name'] = $review->name;
        $this->review['description'] = $review->description;
        $this->review['reviewer_id'] = $review->reviewer_id;
        $this->review['reviewee'] = $review->reviewees->pluck('id')->all();
        $this->action = 'updateReview';
        $this->dispatchBrowserEvent('review-edit');
    }

    public function updateReview(PerformanceReviewRepositoryInterface $reviewRepository){
        $this->validate();

        $res=$reviewRepository->update($this->reviewId,$this->review);

        $this->action = 'saveReview';
        $this->reviewId = null;
        $this->review =[
            'name'=>'',
            'description'=>'',
            'reviewer_id'=>'',
            'reviewee'=>[],
        ];
        session()->flash('message', 'Performance Review Data Updated successfully.');
        $this->dispatchBrowserEvent('review-edit');
    }



    public function deleteReview(PerformanceReviewRepositoryInterface $reviewRepository,$id){
        $review = $reviewRepository->delete($id);
        session()->flash('message', 'Performance Review Deleted successfully.');
        $this->dispatchBrowserEvent('review-edit');
    }


    public function render(UserRepositoryInterface $userRepository ,PerformanceReviewRepositoryInterface $reviewRepository)
    {
        $allEmployees = $userRepository->all();
        $allReviews = $reviewRepository->paginate(2,[],['reviewer']);
        return view('livewire.performance-reviews.index',compact('allEmployees','allReviews'));
    }

    protected function rules()
    {
        return [
            'review.name' => 'required|regex:/^[a-zA-Z0-9\s]+$/|max:500',
            'review.description' => 'required',
            'review.reviewer_id' => 'required|exists:users,id',
            'review.reviewee' => 'required|array|min:1',
            'review.reviewee.*' => 'required|exists:users,id'
        ];

    }
}
