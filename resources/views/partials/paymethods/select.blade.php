<select required class="form-control" id="paymentMethod" name="payment_method">
    <option value="">Selection um método de pagamento</option>
    @foreach($paymentMethods as $pm)
    <option value="{{ $pm['id'] }}">{{ $pm['name'] }}</option>
    @endforeach
</select>
