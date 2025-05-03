<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PayPalPlan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PlanController extends Controller
{
    public function plans()
    {
        $plans = PayPalPlan::all();

        return view('admin.plans.index', compact('plans'));
    }

    public function create()
    {
        $plans = PayPalPlan::all();
        if (count($plans) <= 3) {
            return view('admin.plans.create');
        } else {
            return redirect()->route('admin.plans')->with(['error' => 'Plan limit exceeded']);
        }
    }

    public function store(Request $request)
    {


        $request->validate([
            'name' => "required|unique:pay_pal_plans,name|min:3",
            'key' => "required|unique:pay_pal_plans,plan_key",
            'duration' => "required|min:1|max:12",
            'price' => "required|numeric"
        ]);

        $plan = PayPalPlan::create([
            'uuid' => \Str::uuid(),
            'name' => $request->name,
            'duration' => $request->duration,
            'price' => (float) $request->price,
            'plan_key' => $request->key
        ]);

        return redirect()->route('admin.plans');

    }

    public function edit($uuid)
    {
        $plan = PayPalPlan::where('uuid', $uuid)->first();
        if ($plan) {
            return view('admin.plans.edit', compact('plan'));
        }
        return redirect()->route('admin.plans')->with(['error' => 'plan not found']);
    }

    public function delete($uuid)
    {
        $plan = PayPalPlan::where('uuid', $uuid)->first();
        if ($plan) {
            $plan->delete();
            return redirect()->route('admin.plans')->with(['success' => "Plan deleted successfully"]);
        }
        return redirect()->route('admin.plans')->with(['error' => "Plan not found"]);
    }

    public function update(Request $request, $uuid)
    {
        $plan = PayPalPlan::where('uuid', $uuid)->first();

        if (!$plan) {
            return redirect()->route('admin.plans')->with(['error' => "Plan not found"]);
        }

        $request->validate([

            // 'key' => [
            //     'required',
            //     Rule::unique('pay_pal_plans', 'plan_key')->ignore($plan->id)
            // ],
            'duration' => 'required|integer|min:1|max:12',
            'price' => 'required|numeric',
            'key' => 'required',
            'stripe_key' => 'required'
        ]);

        // $plan->name = $request->name;
        $plan->plan_key = $request->key;
        $plan->stripe_plan_key = $request->stripe_key;
        $plan->duration = $request->duration;
        $plan->price = $request->price;
        $plan->save();
        return redirect()->route('admin.plans')->with(['success' => "Plan updated successfully"]);
    }
}
