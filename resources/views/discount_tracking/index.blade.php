@extends('template.master')

@section('content')
<style>
    :root {
        --primary-dark: #1a2a6c;
        --primary-light: #3a4a8c;
        --secondary-dark: #b21f1f;
        --secondary-light: #d33f3f;
        --accent-gold: #d4af37;
        --light-bg: #f8f9fa;
        --text-dark: #333333;
        --text-light: #f8f9fa;
        --border-radius: 12px;
        --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s ease;
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Poppins', 'Montserrat', sans-serif;
        color: var(--text-dark);
    }

    .discount-header {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
        color: white;
        padding: 3rem 0;
        text-align: center;
        margin-bottom: 3rem;
        border-radius: 0 0 var(--border-radius) var(--border-radius);
        box-shadow: var(--box-shadow);
    }

    .discount-header h1 {
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .discount-header p {
        font-size: 1.3rem;
        font-weight: 300;
        max-width: 600px;
        margin: 0 auto;
        opacity: 0.9;
    }

    .summary-stats {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2.5rem;
        flex-wrap: wrap;
    }

    .stat-card {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 1.5rem;
        flex: 1;
        margin: 0 0.5rem 1rem;
        min-width: 200px;
        text-align: center;
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .stat-card .value {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin-bottom: 0.5rem;
    }

    .stat-card .label {
        font-size: 0.95rem;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        margin-bottom: 2.5rem;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
        color: white;
        padding: 1.5rem;
        font-weight: 600;
        border-bottom: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h4 {
        margin: 0;
        font-size: 1.4rem;
        font-weight: 600;
    }

    .card-body {
        padding: 0;
        background-color: #ffffff;
    }

    .discount-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        transition: var(--transition);
    }

    .discount-info:hover {
        background-color: rgba(26, 42, 108, 0.03);
    }

    .discount-info:last-child {
        border-bottom: none;
    }

    .discount-info h4 {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 1.1rem;
        margin: 0;
    }

    .discount-info span {
        font-size: 1.1rem;
        color: var(--text-dark);
        font-weight: 500;
    }

    .badge-discount {
        background: linear-gradient(135deg, var(--secondary-dark), var(--secondary-light));
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .badge-expiry {
        background-color: #f8d7da;
        color: #721c24;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .badge-savings {
        background-color: #d4edda;
        color: #155724;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        letter-spacing: 1px;
        color: white;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(26, 42, 108, 0.2);
        margin: 1.5rem 2rem;
        width: calc(100% - 4rem);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 42, 108, 0.3);
    }

    .btn-secondary {
        background: linear-gradient(135deg, var(--secondary-dark), var(--secondary-light));
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        letter-spacing: 1px;
        color: white;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(178, 31, 31, 0.2);
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(178, 31, 31, 0.3);
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        padding: 0 2rem 1.5rem;
    }

    .footer-note {
        text-align: center;
        color: #777;
        margin-top: 1rem;
        font-size: 0.9rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .discount-header h1 {
            font-size: 2.5rem;
        }
        
        .discount-header p {
            font-size: 1.1rem;
        }
        
        .summary-stats {
            flex-direction: column;
        }
        
        .stat-card {
            margin: 0 0 1rem;
        }
        
        .discount-info {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .discount-info span {
            margin-top: 0.5rem;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-secondary {
            margin-top: 1rem;
        }
    }
</style>

<div class="discount-header">
    <div class="container">
        <h1>Your Discount Dashboard</h1>
        <p>Track and manage all your rewards, discounts, and savings in one place.</p>
    </div>
</div>

<div class="container">
    <h2>Eligible Customers for Discounts</h2>

    <div class="table-responsive">
        <table class="table hotel-table">
            <thead class="bg-light-blue text-white">
                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Number of Completed Reservations</th>
                    <th>Reward</th>
                </tr>
            </thead>
            <tbody>
    @forelse ($customers as $index => $customerData)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $customerData['customer']->name }}</td>
            <td>{{ $customerData['reservation_count'] }}</td>
            <td>
                <span class="badge hotel-badge bg-success-light text-success">
                    15% OFF on next booking
                </span>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center">No customers eligible for discount yet.</td>
        </tr>
    @endforelse
</tbody>

        </table>
    </div>

</div>

@endsection