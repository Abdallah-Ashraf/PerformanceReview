<?php

namespace App\Http\Livewire;

use App\Repository\PerformanceReviewRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;
use Auth;

class FeedbackRequest extends Component
{

    use WithPagination;

    public $review =[
        'name'=>'',
        'description'=>'',
        'feedback'=>'',
        'reviewer_name'=>'',
        'reviewee'=>'',
    ];
    public $action = '';
    public $reviewId;

    protected $validationAttributes = [
        'review.feedback' => 'Feedback'
    ];


    public function editReview(PerformanceReviewRepositoryInterface $reviewRepository,$id){
        $review=$reviewRepository->find($id,['reviewees','reviewer']);
        $this->reviewId = $id;
        $this->review['name'] = $review->name;
        $this->review['description'] = $review->description;
        $this->review['reviewer_name'] = $review->reviewer->name;
        $this->review['reviewee'] = implode(',',$review->reviewees->pluck('name')->all());
        $this->action = 'submitFeedback';
        $this->dispatchBrowserEvent('review-edit');
    }


    public function submitFeedback(PerformanceReviewRepositoryInterface $reviewRepository){
        $this->validate();
        $data['feedback'] = $this->review['feedback'];
        $data['status'] = 'Closed';
        $res=$reviewRepository->update($this->reviewId,$data);

        $this->action = '';
        $this->reviewId = null;
        $this->review =[
            'name'=>'',
            'description'=>'',
            'feedback'=>'',
            'reviewer_name'=>'',
            'reviewee'=>'',
        ];
        session()->flash('message', 'Feedback Saved successfully.');
        $this->dispatchBrowserEvent('review-edit');
    }

    public function render(PerformanceReviewRepositoryInterface $reviewRepository)
    {
        $allReviews = $reviewRepository->paginate(2,['reviewer_id'=>Auth::user()->id],['reviewer','reviewees']);
        return view('livewire.feedback-request.index',compact('allReviews'));
    }

    protected function rules()
    {
        return [
            'review.feedback' => 'required',
        ];

    }
}
