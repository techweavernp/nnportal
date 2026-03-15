<!-- Election Vote Count Section -->
<style>
    /* ===== Election Result Banner ===== */
    .election-result-section {
        padding: 1.5rem 0;
        background-color: var(--white);
    }

    .election-card {
        background: linear-gradient(135deg, #fdfdfd 0%, #f1f1f1 100%);
        border: 1px solid var(--border-gray);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        position: relative;
    }

    .election-header {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--primary-red);
        padding-bottom: 0.75rem;
    }

    .election-title-group {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .live-indicator {
        background: var(--primary-red);
        color: white;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        animation: flash 1.5s infinite;
    }

    @keyframes flash {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.4;
        }

        100% {
            opacity: 1;
        }
    }

    .election-main-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--black);
    }

    .election-update-time {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        color: var(--light-gray);
        font-size: 0.85rem;
    }

    .party-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.25rem;
    }

    .party-stat-item {
        background: var(--white);
        padding: 1rem;
        border-radius: 8px;
        border: 1px solid var(--border-gray);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
    }

    .party-stat-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.05);
        border-color: var(--primary-red);
    }

    .party-logo-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #f9f9f9;
        padding: 5px;
        margin-bottom: 0.75rem;
        border: 2px solid transparent;
    }

    .party-logo-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 50%;
    }

    .party-stat-item:hover .party-logo-wrapper {
        border-color: var(--primary-red);
    }

    .party-name-info {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark-gray);
        margin-bottom: 0.25rem;
    }

    .vote-count-number {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--light-black);
        margin-bottom: 0.5rem;
    }

    .vote-progress-bar {
        width: 100%;
        height: 6px;
        background: #eee;
        border-radius: 3px;
        overflow: hidden;
    }

    .vote-progress-fill {
        height: 100%;
        background: var(--light-gray);
        border-radius: 3px;
    }

    .election-footer-action {
        margin-top: 1.5rem;
        text-align: right;
    }

    .view-all-results {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--primary-red);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .view-all-results:hover {
        text-decoration: underline;
    }

    @media (max-width: 600px) {
        .party-stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .election-main-title {
            font-size: 1.1rem;
        }
    }
</style>
<section class="election-result-section reveal">
    <div class="container">
        <div class="election-card">
            <div class="election-header">
                <div class="election-title-group">
                    <span class="live-indicator">LIVE</span>
                    <h2 class="election-main-title">निर्वाचन २०८२ : ताजा मतपरिणाम</h2>
                </div>
                <div class="election-update-time">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    @php
                        $election = \App\Models\ElectionResult::find(1);
                    @endphp
                    अपडेट: {{ $election->updatedAtHuman }}
                </div>
            </div>

            <div class="party-stats-grid">
                @foreach($electionResults as $result)
                    <div class="party-stat-item">
                        <div class="party-logo-wrapper">
                            <img src="{{ asset('storage/' . $result->logo) }}" alt="{{$result->party_name}}">
                        </div>
                        <div class="party-name-info">{{$result->party_name}}</div>
                        <div class="vote-count-number">{{$result->seats_won}} / २७५</div>
                        <div class="vote-progress-bar">
                            <div class="vote-progress-fill" style="width: {{round($result->seats_won/275 * 100)}}%;"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- <div class="election-footer-action">
                <a href="#" class="view-all-results">सबै परिणाम हेर्नुहोस् &rarr;</a>
            </div> -->
        </div>
    </div>
</section>
