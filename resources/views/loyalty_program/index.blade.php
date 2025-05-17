@extends('template.master')
@section('title', 'Loyalty Program')
@section('content')
<style>
    :root {
        --primary-dark: #1a2a6c;
        --primary-light: #3a4a8c;
        --secondary-dark: #b21f1f;
        --secondary-light: #d33f3f;
        --accent-gold: #d4af37;
        --accent-silver: #c0c0c0;
        --accent-bronze: #cd7f32;
        --light-bg: #f8f5f2;
        --text-dark: #333333;
        --text-light: #f8f9fa;
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.12);
        --shadow-lg: 0 8px 24px rgba(0,0,0,0.16);
    }
    
    body {
        background-color: var(--light-bg);
        font-family: 'Montserrat', sans-serif;
        color: var(--text-dark);
    }
    
    .loyalty-header {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
        color: white;
        padding: 4rem 0 3rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }
    
    .loyalty-header::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }
    
    .loyalty-header h1 {
        font-weight: 800;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: relative;
    }
    
    .loyalty-header p {
        opacity: 0.9;
        position: relative;
    }
    
    .loyalty-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 2rem;
        background: white;
        position: relative;
    }
    
    .loyalty-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }
    
    .card-header {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
        color: white;
        padding: 1.5rem;
        font-weight: 600;
        letter-spacing: 1px;
        position: relative;
    }
    
    .points-card .card-header {
        background: linear-gradient(135deg, var(--secondary-dark), var(--secondary-light));
    }
    
    .card-body {
        padding: 2rem;
    }
    
    .benefit-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .benefit-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    
    .benefit-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.5rem;
        flex-shrink: 0;
        font-size: 1.25rem;
        box-shadow: var(--shadow-sm);
    }
    
    .points-display {
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--primary-dark);
        margin: 1rem 0;
        text-align: center;
        position: relative;
    }
    
    .points-display::after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, var(--accent-gold), #f1c40f);
        border-radius: 3px;
    }
    
    .points-label {
        font-size: 1rem;
        color: var(--text-dark);
        text-align: center;
        margin-bottom: 1.5rem;
    }
    
    .btn-loyalty {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-light));
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        font-weight: 600;
        letter-spacing: 1px;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(26, 42, 108, 0.2);
    }
    
    .btn-loyalty:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(26, 42, 108, 0.3);
        color: white;
    }
    
    .btn-redeem {
        background: linear-gradient(135deg, var(--secondary-dark), var(--secondary-light));
    }
    
    .tier-badge {
        background: linear-gradient(135deg, var(--accent-gold), #f1c40f);
        color: var(--text-dark);
        padding: 5px 15px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.8rem;
        display: inline-block;
        margin-bottom: 1rem;
        box-shadow: var(--shadow-sm);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .progress {
        height: 10px;
        border-radius: 5px;
        margin: 1.5rem 0;
        background-color: #e9ecef;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
    }
    
    .progress-bar {
        background: linear-gradient(90deg, var(--accent-gold), #f1c40f);
        transition: width 0.6s ease;
    }
    
    .membership-card {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #2c3e50, #4ca1af);
        color: white;
        border-radius: 15px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        z-index: 1;
    }
    
    .membership-card::before {
        content: "";
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        z-index: -1;
    }
    
    .membership-card::after {
        content: "";
        position: absolute;
        bottom: -30%;
        right: -30%;
        width: 150px;
        height: 150px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
        z-index: -1;
    }
    
    /* New Styles */
    .status-indicator {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(0,0,0,0.2);
        border-radius: 50px;
        padding: 5px 10px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .reward-card {
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }
    
    .reward-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
    }
    
    .reward-card img {
        height: 150px;
        object-fit: cover;
    }
    
    .reward-card .card-body {
        padding: 1.5rem;
    }
    
    .reward-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: var(--secondary-light);
        color: white;
        border-radius: 50px;
        padding: 3px 10px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    
    .tier-progress {
        display: flex;
        align-items: center;
        margin: 2rem 0;
    }
    
    .tier-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        flex-shrink: 0;
        font-size: 1rem;
        color: white;
    }
    
    .tier-icon.bronze {
        background: linear-gradient(135deg, var(--accent-bronze), #b87333);
    }
    
    .tier-icon.silver {
        background: linear-gradient(135deg, var(--accent-silver), #a8a8a8);
    }
    
    .tier-icon.gold {
        background: linear-gradient(135deg, var(--accent-gold), #d4af37);
    }
    
    .tier-icon.platinum {
        background: linear-gradient(135deg, #e5e4e2, #b6b6b6);
    }
    
    .tier-progress-container {
        flex-grow: 1;
    }
    
    .tier-name {
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .tier-threshold {
        font-size: 0.8rem;
        color: rgba(255,255,255,0.8);
    }
    
    .animated-points {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .point-activity {
        max-height: 300px;
        overflow-y: auto;
        padding-right: 10px;
    }
    
    .activity-item {
        display: flex;
        padding: 10px 0;
        border-bottom: 1px dashed rgba(0,0,0,0.1);
    }
    
    .activity-date {
        font-size: 0.8rem;
        color: var(--text-dark);
        opacity: 0.7;
        min-width: 80px;
    }
    
    .activity-desc {
        flex-grow: 1;
        padding: 0 15px;
    }
    
    .activity-points {
        font-weight: 600;
        color: var(--primary-dark);
    }
    
    .activity-points.negative {
        color: var(--secondary-light);
    }
    
    .section-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }
    
    .section-title::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary-dark), var(--primary-light));
        border-radius: 3px;
    }
    
    .floating-rewards {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 1000;
    }
    
    .floating-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--secondary-dark), var(--secondary-light));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-lg);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .floating-btn:hover {
        transform: scale(1.1);
    }
    
    .floating-label {
        position: absolute;
        right: 70px;
        background: white;
        padding: 8px 15px;
        border-radius: 50px;
        box-shadow: var(--shadow-sm);
        font-size: 0.8rem;
        font-weight: 600;
        white-space: nowrap;
        opacity: 0;
        transition: all 0.3s ease;
        pointer-events: none;
    }
    
    .floating-btn:hover .floating-label {
        opacity: 1;
        right: 80px;
    }
    
    @media (max-width: 768px) {
        .loyalty-header {
            padding: 3rem 0 2rem;
        }
        
        .points-display {
            font-size: 2.5rem;
        }
        
        .benefit-item {
            flex-direction: column;
        }
        
        .benefit-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }
    }
</style>

<div class="loyalty-header text-center">
    <div class="container">
        <h1 class="display-4 font-weight-bold mb-3">Loyalty Rewards Program</h1>
        <p class="lead mb-4">Your journey to exclusive benefits starts here</p>
        <span class="tier-badge animated-points">Gold Member</span>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <!-- Membership Card -->
        <div class="col-12 mb-5">
            <div class="membership-card">
                <span class="status-indicator">Active Member</span>
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="font-weight-bold mb-3">Welcome Back, Customer!</h3>
                        <p class="mb-4">You're enjoying Gold tier benefits at our luxury hotels worldwide.</p>
                        
                        <div class="tier-progress">
                            <div class="tier-icon bronze">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div class="tier-icon silver">
                                <i class="fas fa-medal"></i>
                            </div>
                            <div class="tier-icon gold">
                                <i class="fas fa-crown"></i>
                            </div>
                            <div class="tier-icon platinum">
                                <i class="fas fa-star"></i>
                            </div>
                            
                            <div class="tier-progress-container ml-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="tier-name">Gold Tier</span>
                                    <span class="tier-threshold">65% to Platinum</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <small>1,500 pts</small>
                                    <small>2,300 pts needed</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <button class="btn btn-loyalty btn-redeem mb-2">Redeem Points</button>
                        <button class="btn btn-outline-light">How to Earn More</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <div class="col-lg-6 col-md-12">
            <div class="loyalty-card h-100">
                <div class="card-header text-center">
                    <h4 class="mb-0">YOUR BENEFITS</h4>
                </div>
                <div class="card-body">
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-gem"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold">Elite Status</h5>
                            <p class="mb-0">Priority check-in/out, room upgrades when available, and dedicated concierge service.</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold">Accelerated Earnings</h5>
                            <p class="mb-0">Gold members earn 15% more points on every stay and eligible purchases.</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-glass-cheers"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold">Welcome Amenities</h5>
                            <p class="mb-0">Complimentary premium drink and gourmet fruit basket upon arrival.</p>
                        </div>
                    </div>
                    <div class="benefit-item">
                        <div class="benefit-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h5 class="font-weight-bold">Flexible Checkout</h5>
                            <p class="mb-0">Guaranteed 2pm late checkout upon request with no additional fees.</p>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button class="btn btn-loyalty">View All Benefits</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Points Section -->
        <div class="col-lg-6 col-md-12">
            <div class="loyalty-card points-card h-100">
                <div class="card-header text-center">
                    <h4 class="mb-0">YOUR POINTS</h4>
                </div>
                <div class="card-body">
                    <div class="points-display animated-points">1,500</div>
                    <div class="points-label">Available Reward Points</div>
                    
                    <div class="row mb-4">
                        <div class="col-6 text-center">
                            <div class="font-weight-bold text-primary">+500</div>
                            <small>Earned this month</small>
                        </div>
                        <div class="col-6 text-center">
                            <div class="font-weight-bold text-danger">-200</div>
                            <small>Redeemed this month</small>
                        </div>
                    </div>
                    
                    <h5 class="font-weight-bold mb-3 text-center">Recent Activity</h5>
                    <div class="point-activity">
                        <div class="activity-item">
                            <div class="activity-date">Today</div>
                            <div class="activity-desc">Points earned from stay #45892</div>
                            <div class="activity-points">+250</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-date">Jun 15</div>
                            <div class="activity-desc">Dining credit redemption</div>
                            <div class="activity-points negative">-200</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-date">Jun 10</div>
                            <div class="activity-desc">Birthday bonus points</div>
                            <div class="activity-points">+100</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-date">Jun 5</div>
                            <div class="activity-desc">Referral bonus</div>
                            <div class="activity-points">+150</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-date">May 28</div>
                            <div class="activity-desc">Points earned from stay #44521</div>
                            <div class="activity-points">+300</div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button class="btn btn-loyalty">View Full History</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Rewards Section -->
<div class="container py-5">
    <div class="row">
        <div class="col-12 mb-5">
            <h2 class="section-title">Redeem Your Points</h2>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="reward-card">
                <div class="reward-badge">1,000 pts</div>
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Dining Credit">
                <div class="card-body text-center">
                    <h5 class="font-weight-bold">$50 Dining Credit</h5>
                    <p class="small mb-3">Enjoy a gourmet meal at our restaurants</p>
                    <button class="btn btn-sm btn-loyalty">Redeem Now</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="reward-card">
                <div class="reward-badge">2,500 pts</div>
                <img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Room Upgrade">
                <div class="card-body text-center">
                    <h5 class="font-weight-bold">Room Upgrade</h5>
                    <p class="small mb-3">Enhanced room category on your next stay</p>
                    <button class="btn btn-sm btn-loyalty">Redeem Now</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="reward-card">
                <div class="reward-badge">5,000 pts</div>
                <img src="https://images.unsplash.com/photo-1534258936925-c58bed479fcb?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Spa Package">
                <div class="card-body text-center">
                    <h5 class="font-weight-bold">Spa Experience</h5>
                    <p class="small mb-3">60-minute massage for two</p>
                    <button class="btn btn-sm btn-loyalty">Redeem Now</button>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="reward-card">
                <div class="reward-badge">10,000 pts</div>
                <img src="https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="card-img-top" alt="Free Night">
                <div class="card-body text-center">
                    <h5 class="font-weight-bold">Free Night Stay</h5>
                    <p class="small mb-3">Complimentary night at any standard room</p>
                    <button class="btn btn-sm btn-loyalty">Redeem Now</button>
                </div>
            </div>
        </div>
        
        <div class="col-12 text-center mt-3">
            <button class="btn btn-loyalty">Browse All Rewards</button>
        </div>
    </div>
</div>

<!-- Tier Benefits Section -->
<div class="container-fluid py-5" style="background-color: #f0f2f5;">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-5">
                <h2 class="section-title">Tier Benefits Comparison</h2>
                <p class="lead">Reach higher tiers for more exclusive privileges</p>
            </div>
            
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered bg-white">
                        <thead class="thead-dark">
                            <tr>
                                <th>Benefit</th>
                                <th class="text-center">Standard</th>
                                <th class="text-center">Silver</th>
                                <th class="text-center">Gold</th>
                                <th class="text-center">Platinum</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Points Earn Rate</td>
                                <td class="text-center">5 pts/$</td>
                                <td class="text-center">7 pts/$</td>
                                <td class="text-center">10 pts/$</td>
                                <td class="text-center">12 pts/$</td>
                            </tr>
                            <tr>
                                <td>Room Upgrade</td>
                                <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                                <td class="text-center">On Request</td>
                                <td class="text-center">Priority</td>
                                <td class="text-center">Suite Upgrade</td>
                            </tr>
                            <tr>
                                <td>Late Checkout</td>
                                <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                                <td class="text-center">1pm</td>
                                <td class="text-center">2pm</td>
                                <td class="text-center">4pm</td>
                            </tr>
                            <tr>
                                <td>Welcome Amenity</td>
                                <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                                <td class="text-center">Drink</td>
                                <td class="text-center">Drink + Fruit</td>
                                <td class="text-center">Premium Basket</td>
                            </tr>
                            <tr>
                                <td>Free Wi-Fi</td>
                                <td class="text-center">Standard</td>
                                <td class="text-center">Premium</td>
                                <td class="text-center">Premium</td>
                                <td class="text-center">Ultra Premium</td>
                            </tr>
                            <tr>
                                <td>Annual Gift</td>
                                <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                                <td class="text-center"><i class="fas fa-times text-muted"></i></td>
                                <td class="text-center">Yes</td>
                                <td class="text-center">Premium Gift</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="col-12 text-center mt-4">
                <button class="btn btn-loyalty">Learn How to Reach Next Tier</button>
            </div>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<div class="container py-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h2 class="section-title" style="border-bottom: none; text-align: center;">How Our Loyalty Program Works</h2>
            <p class="lead">Start earning rewards from your very first stay</p>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="text-center px-3">
                <div class="bg-primary-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin-bottom: 1.5rem; box-shadow: var(--shadow-sm);">
                    <i class="fas fa-sign-in-alt fa-2x"></i>
                </div>
                <h4 class="font-weight-bold mb-3">1. Join Free</h4>
                <p class="small">Register online or at any property to become a member instantly.</p>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="text-center px-3">
                <div class="bg-primary-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin-bottom: 1.5rem; box-shadow: var(--shadow-sm);">
                    <i class="fas fa-hotel fa-2x"></i>
                </div>
                <h4 class="font-weight-bold mb-3">2. Earn Points</h4>
                <p class="small">Collect points for every dollar spent on stays and services.</p>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="text-center px-3">
                <div class="bg-primary-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin-bottom: 1.5rem; box-shadow: var(--shadow-sm);">
                    <i class="fas fa-arrow-up fa-2x"></i>
                </div>
                <h4 class="font-weight-bold mb-3">3. Reach Tiers</h4>
                <p class="small">Earn status tiers for more valuable benefits.</p>
            </div>
        </div>
        
        <div class="col-md-3 col-6 mb-4">
            <div class="text-center px-3">
                <div class="bg-primary-dark text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; margin-bottom: 1.5rem; box-shadow: var(--shadow-sm);">
                    <i class="fas fa-gift fa-2x"></i>
                </div>
                <h4 class="font-weight-bold mb-3">4. Redeem Rewards</h4>
                <p class="small">Use points for free nights, upgrades, and exclusive experiences.</p>
            </div>
        </div>
    </div>
</div>

<!-- Special Offers Section -->
<div class="container-fluid py-5" style="background: linear-gradient(135deg, #2c3e50, #4ca1af); color: white;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title" style="border-color: white; color: white;">Exclusive Member Offers</h2>
                <p class="lead">Special deals just for our loyalty members</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="card-img-top" alt="Weekend Getaway">
                    <div class="card-body">
                        <span class="badge badge-warning mb-2">MEMBERS ONLY</span>
                        <h5 class="card-title font-weight-bold">Weekend Escape</h5>
                        <p class="card-text">Enjoy 20% off weekend stays plus double points when you book by August 31.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge badge-primary">500 Bonus Points</span>
                            <a href="#" class="btn btn-sm btn-primary">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1534258936925-c58bed479fcb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80" class="card-img-top" alt="Spa Package">
                    <div class="card-body">
                        <span class="badge badge-warning mb-2">GOLD TIER+</span>
                        <h5 class="card-title font-weight-bold">Spa Indulgence</h5>
                        <p class="card-text">Complimentary 60-minute massage when you stay 3 nights or more.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge badge-primary">Save $120</span>
                            <a href="#" class="btn btn-sm btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-lg">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" class="card-img-top" alt="Dining Offer">
                    <div class="card-body">
                        <span class="badge badge-warning mb-2">ALL MEMBERS</span>
                        <h5 class="card-title font-weight-bold">Dining Credit</h5>
                        <p class="card-text">Get $50 dining credit or redeem 500 points for a romantic dinner for two.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge badge-primary">Limited Time</span>
                            <a href="#" class="btn btn-sm btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12 text-center">
                <button class="btn btn-outline-light">View All Special Offers</button>
            </div>
        </div>
    </div>
</div>

<!-- Floating Redeem Button -->
<div class="floating-rewards">
    <div class="floating-btn">
        <i class="fas fa-gift fa-lg"></i>
        <span class="floating-label">Redeem Points</span>
    </div>
</div>

<script>
    // Simple animation for points display
    document.addEventListener('DOMContentLoaded', function() {
        const pointsDisplay = document.querySelector('.points-display');
        
        setInterval(() => {
            pointsDisplay.classList.toggle('animated-points');
        }, 3000);
    });
</script>
@endsection