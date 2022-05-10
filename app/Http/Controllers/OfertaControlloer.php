<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\OfertaUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class OfertaControlloer extends Controller
{
    public function registerOferta(Request $request)
    {

        DB::beginTransaction();

        try {

            if (!JWTAuth::parseToken()->authenticate()) {
                return response()->json(['No se encuentra el usuario'], 404);
            }


            $users = $request['usuarios_asociados'];
            $oferta =  DB::table('ofertas')->where('nombre_oferta', $request['nombre_oferta'])->first();
            if (!$oferta || empty($oferta) || is_null($oferta)) {
                $oferta = Oferta::create([
                    'nombre_oferta' => $request->input('nombre_oferta'),
                    'estado' => $request->input('estado')
                ]);
            }


            foreach ($users as $key => $value) {
                $user = User::find($value);
                $user_oferta = DB::select('select * from users u inner join oferta_usuarios of ON of.user_id = u.id WHERE of.user_id = ' . $value . '  and of.oferta_id = ' . $oferta->id);

                if ($user_oferta) {
                    return response([
                        'message' => 'Existen usuarios que ya han aplicado a la oferta'
                    ], 200);
                }

                if ($user) {
                    OfertaUsuario::create([
                        'oferta_id' => $oferta->id,
                        'user_id' => $value
                    ]);
                } else {
                    return response(['message' => 'No se puede relacionar la oferta a un usuario que no existe'], Response::HTTP_NOT_FOUND);
                }
            }


            DB::commit();
            return response(
                [
                    'message' => 'Oferta Guardada'
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return response(['message' => $th->getMessage()], 500);
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['Token Vencido!'], Response::HTTP_UNAUTHORIZED);
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['Token Invalido'], Response::HTTP_UNAUTHORIZED);
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], Response::HTTP_UNAUTHORIZED);
        }
    }

    public function listofertas()
    {
        try {

            if (!JWTAuth::parseToken()->authenticate()) {
                return response()->json(['No se encuentra el usuario'], 404);
            }

            $r =  DB::select(
                "SELECT o.id,o.nombre_oferta, group_concat(u.name) usuarios  
            FROM ofertas o  
            INNER JOIN oferta_usuarios of ON  of.oferta_id = o.id 
            INNER JOIN  users u ON u.id = of.user_id
            GROUP BY o.id,o.nombre_oferta"
            );

            return response([
                'ofertas' => $r
            ], Response::HTTP_OK);
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['Token Vencido!'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['Token Invalido'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
    }
}
