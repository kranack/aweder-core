<div class="field col-span-6 m-col-span-12 sm-col-span-6 align-items-start">
    <span class="label label--group margin-bottom-20">
        Connect payment platform
    </span>
    @if (!$merchant->hasStripePaymentsIntegration())
        <a href="https://connect.stripe.com/oauth/authorize?client_id={{ $stripeClientId }}&state={{ $status }}&scope=read_write&response_type=code&stripe_user[email]={{$merchant->contact_email}}&redirect_uri={{ route('admin.stripe-oauth.redirect') }}"
           class="button button-outline--stripe">
            <span class="button__content">Connect with Stripe</span>
        </a>
    @else
        <a href="{{ route('admin.stripe-oauth.deauthorize') }}" class="button button-solid--stripe">
            <span class="button__content">Deauthorize Stripe Account</span>
        </a>
    @endif
</div>
