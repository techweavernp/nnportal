<!-- Election Vote Count Section -->
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
