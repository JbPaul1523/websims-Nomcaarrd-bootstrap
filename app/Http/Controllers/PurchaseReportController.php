<?php

namespace App\Http\Controllers;

use App\Models\PurchaseReport;
use App\Models\PrItem;
use App\Models\PrSignatory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PurchaseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $purchaseReports = PurchaseReport::all();
        $prItem = PrItem::all();
        $prSignatory = PrSignatory::all();
        return view('purchaseReport.ManagePr.index', compact('purchaseReports', 'prItem', 'prSignatory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $purchaseReport = PurchaseReport::all();
        $prItems = PrItem::all();

        return view('purchaseReport.ManagePr.create', compact('purchaseReport', 'prItem'));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $request->validate([
            'pr_no' => 'required|unique:purchase_reports',
            'name' => 'required',
            'fund_cluster' => 'required',
            'purpose' => 'required',
            'category' => ['required', Rule::in(['supply', 'services', 'equipment'])],

        ]);

        $purchaseReport = PurchaseReport::create($request->except(['pr_items_id', 'pr_signatories_id']));

        if ($request->has('pr_items_id')) {
            $purchaseReport->items()->attach($request->pr_items_id);
        }
        if ($request->has('pr_signatories_id')) {
            $purchaseReport->signatories()->attach($request->pr_signatories_id);
        }

        PurchaseReport::create($request->all());
        dd($request->all());
        return redirect()->route('purchaseReports')->with('success', 'Purchase report created successfully.');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(PurchaseReport $purchaseReport)
    {
        return view('purchaseReports.show', compact('purchaseReport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(PurchaseReport $purchaseReport)
    {
        return view('purchaseReports.edit', compact('purchaseReport'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, PurchaseReport $purchaseReport)
    {
        $request->validate([
            'pr_no' => 'required|unique:purchase_reports',
            'name' => 'required',
            'fund_cluster' => 'required',
            'purpose' => 'required',
            'category' => ['required', Rule::in(['supply', 'services', 'equipment'])],
            'pr_items_id' => 'nullable|array',
            'pr_items_id.*' => 'exists:pr_items,id',
            'pr_signatories_id' => 'nullable|array',
            'pr_signatories_id.*' => 'exists:pr_signatories,id',
        ]);

        $purchaseReport = PurchaseReport::create($request->except(['pr_items_id', 'pr_signatories_id']));

        if ($request->has('pr_items_id')) {
            $purchaseReport->items()->attach($request->pr_items_id);
        }
        if ($request->has('pr_signatories_id')) {
            $purchaseReport->signatories()->attach($request->pr_signatories_id);
        }

        $purchaseReport->update($request->all());
        return redirect()->route('purchaseReports.index')->with('success', 'Purchase report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(PurchaseReport $purchaseReport)
    {
        $purchaseReport->delete();
        return redirect()->route('purchaseReports.index')->with('success', 'Purchase report deleted successfully');
    }


    public function reportPDF($id)
    {
        $signatures = PrSignatory::take(2);

        $executive = [];

        foreach ($signatures as $signatory) {
            $executive[] = $signatory;
        }

        $firstExecutive = $executive[0];
        $secondExecutive = $executive[1];

        /* $reportPurchase = PurchaseReport::;
 */
        $html = '<table style="border: 1px solid black; border-collapse: collapse; min-width: 100%;">
        <tr align="center">
            <td style="padding: 5px" colspan="6">
                <div style="align-items: center">PURCHASE REQUEST</div>
                <div style="display: flex">
                    <p style="font-size: small; width: 70%; text-align: left">
                        ENTITY NAME: CENTRAL MINDANAO UNIVERSITY
                    </p>
                    <p style="font-size: small; width: 30%; text-align: left">
                        FUND CLUSTER: <span>________</span>
                    </p>
                </div>
            </td>
        </tr>
        <tr style="border: 1px solid black">
            <td align="left" style="padding: 5px; border: 1px solid black; width: fit-content" colspan="2">
                <div style="font-size: smaller">Office/Section</div>
                <span style="font-size: smaller">NOMCAARRD</span>
            </td>
            <td align="left" style="padding: 5px; border: 1px solid black; width: fit-content" colspan="3">
                <div style="font-size: smaller; display: flex">
                    <span>PR NO.</span>
                    <div style="border-bottom: 1px solid black; width: 80%"></div>
                </div>
                <span style="font-size: smaller">REPONSIBILITY CENTER CODE: </span>
                <p></p>
            </td>
            <td align="left" style="padding: 5px; border: 1px solid black; width: 18%">
                <div style="font-size: small; display: flex">
                    <span>DATE: </span>
                    <div style="border-bottom: 1px solid black; width: 100%"></div>
                </div>
            </td>
        </tr>
        <tr style="font-size: small;">
            <td style="width: 10%; border: 1px solid black">Stock No.</td>
            <td style="width: 10%; border: 1px solid black">Unit</td>
            <td style="width: 40%; border: 1px solid black;">Description</td>
            <td style="max-width: 10%; border: 1px solid black">Quantity</td>
            <td style="max-width: 15%; border: 1px solid black">Unit Cost</td>
            <td style="max-width: 15%; border: 1px solid black">Total Cost</td>
        </tr>';

     /*    foreach(){

        } */

        $html .= '<tr style="font-size: small;">
            <td style="width: 10%; border: 1px solid black"></td>
            <td style="width: 10%; border: 1px solid black"></td>
            <td style="width: 40%; border: 1px solid black;"></td>
            <td style="max-width: 10%; border: 1px solid black"></td>
            <td style="max-width: 15%; border: 1px solid black">Total Cost</td>
            <td style="max-width: 15%; border: 1px solid black"></td>
            </td>
        </tr>
        <tr style="height: 4rem; align-items:normal;">
            <td colspan="6">
                <span style="font-size: small; margin: 10px;"> Purpose </span>
                <br>
                <div>
                    <p></p>
                </div>
            </td>
        </tr>
        <tr style="border: 1px solid black; align-items: normal; font-size: small;">
            <td colspan="2" style="border: 1px solid black;">
                <br>
                <span style="padding: 2px;">Signature: </span>
                <br>
                <span style="padding: 2px;">Printed Name:</span>
                <br>
                <span style="padding: 2px;">Designation: </span>
            </td>
            <td colspan="2" style="border: 1px solid black;">
                <div>Requested by</div>
                &nbsp;
                <div style="text-align: center;">
                    <span style="padding: 0px">' . $firstExecutive->name . ' </span>
                    <br>
                    <span style="padding: 0px; font-weight: 700;">' . $firstExecutive->position . '</span>
                </div>
            </td>
            <td colspan="2" style="border: 1px solid black;">
                <div>Approved by</div>
                &nbsp;
                <div style="text-align: center;">
                    <span style="padding: 0px">' . $secondExecutive->name . '</span>
                    <br>
                    <span style="padding: 0px; font-weight: 700;">' . $secondExecutive->position . '</span>
                </div>
            </td>
        </tr>
    </table>';

        return response()->json($html);
    }
}
