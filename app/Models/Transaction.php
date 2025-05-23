<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'room_id',
        'check_in',
        'check_out',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    // In App\Models\Transaction
public function room()
{
    return $this->belongsTo(Room::class);
}

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function getTotalPrice()
    {
        $day = Helper::getDateDifference($this->check_in, $this->check_out);
        $room_price = $this->room->price;

        return $room_price * $day;
    }

    public function getDateDifferenceWithPlural()
    {
        $day = Helper::getDateDifference($this->check_in, $this->check_out);
        $plural = Str::plural('Day', $day);

        return $day.' '.$plural;
    }

    public function getTotalPayment()
    {
        $totalPayment = 0;
        foreach ($this->payment as $payment) {
            $totalPayment += $payment->price;
        }

        return $totalPayment;
    }

    public function getMinimumDownPayment()
    {
        $dayDifference = Helper::getDateDifference($this->check_in, $this->check_out);

        return ($this->room->price * $dayDifference) * 0.15;
    }

    public function getTotalServicePrice()
{
    return $this->services_h ? $this->services_h->sum('price') : 0;
}

// Update the booted method in Transaction model
protected static function booted()
{
    static::created(function ($transaction) {
        // Mark as occupied when transaction is created
        $transaction->room->update(['room_status_id' => 2]); // Occupied
    });

    static::updated(function ($transaction) {
        if ($transaction->status === 'Completed') {
            // Mark as vacant when transaction is completed
            $transaction->room->update(['room_status_id' => 1]); // Vacant
        } elseif (in_array($transaction->status, ['Pending', 'Confirmed'])) {
            $now = now();
            if ($now->between($transaction->check_in, $transaction->check_out)) {
                $transaction->room->update(['room_status_id' => 2]); // Occupied
            } else {
                $transaction->room->update(['room_status_id' => 3]); // Reserved
            }
        }
    });

    static::deleted(function ($transaction) {
        // Only mark as vacant if no other active transactions
        $hasActiveTransactions = $transaction->room->transactions()
            ->where('status', '!=', 'Completed')
            ->where('id', '!=', $transaction->id)
            ->exists();
            
        if (!$hasActiveTransactions) {
            $transaction->room->update(['room_status_id' => 1]); // Vacant
        }
    });
}

public function checkOut(Transaction $transaction)
{
    $transaction->update(['status' => 'Completed']);
    // Room status will be automatically updated via the model event
    return redirect()->back()->with('success', 'Room marked as vacant');
}

// Add this relationship to your Room model
public function transactions()
{
    return $this->hasMany(Transaction::class);
}

}
