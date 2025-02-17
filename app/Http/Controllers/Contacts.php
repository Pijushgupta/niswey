<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Contact;
use Illuminate\Http\Request;

class Contacts extends Controller
{
    //

    public function storFile(Request $request){
        
        if(!$request->hasFile('file')){
            return response()->json(['error' => 'File not received'], 400);
        }
        if(!$request->filled('fileName')){
            return response()->json(['error','File name is not provided'],400);
        }
        $filename = $request->input('fileName');
        $index = $request->input('index');
        $total = $request->input('total');
        $chunk = $request->file('file');

        $tempPath = storage_path("app/uploads/{$filename}");
        file_put_contents($tempPath . "_{$index}", file_get_contents($chunk->getRealPath()));

        if ($index + 1 == $total) {
            // Merge all chunks
            $finalFile = $tempPath . ".xml";
            $fileHandle = fopen($finalFile, "wb");

            for ($i = 0; $i < $total; $i++) {
                fwrite($fileHandle, file_get_contents("{$tempPath}_{$i}"));
                unlink("{$tempPath}_{$i}");
            }
            fclose($fileHandle);

            // Process the final XML file
            $this->processXML($finalFile);
        }

        return response()->json(["message" => "Chunk {$index} uploaded"]);
    }

    private function processXML($filePath)
    {
        
        $xml = simplexml_load_file($filePath);
       foreach($xml->contact as $c){
        Contact::create(['first_name'=>(string)$c->name,'last_name'=>(string)$c->lastName,'phone'=>(string)$c->phone]);  
        
       }
       return response()->json(['status'=>'Data inserted successfully'],200);   
    }

    public function contacts( $numberOfPostsPerPage = 20){
        
        $data = Contact::paginate($numberOfPostsPerPage)->withQueryString();
        return Inertia::render('Contacts',['posts'=>$data]);
    }

    public function edit(Request $request){
        $id = $request->query('id');
        $id = is_string($id) ? $id : '';
        
        if(empty($id)) return Inertia::render('Edit');

        $data = Contact::where('id',$id)->first();
       // dd($data);
        return Inertia::render('Edit',['contact'=>$data]);
    }

    /**
     * save or create
     */
    public function save(Request $request){
        $isUpdate = false;
        if($request->filled('id')) $isUpdate = true;

        $contact = $request->validate([
            "first_name" => "required|string",
            "last_name"  => "required|string",
            "phone" => "required|string",
        ]);

        if($isUpdate == false){
            Contact::create($contact);
            
        } 
        if($isUpdate == true){
            $c = Contact::findOrFail($request->id); // Find the post type
            $c->update($contact);
        } 

        return redirect('/contacts');

    }

    public function delete(Request $request){
        $id = $request->query('id');
        if(empty($id)) return;
        $contact = Contact::find($id);
        $contact->delete();
        return back();

    }
}
