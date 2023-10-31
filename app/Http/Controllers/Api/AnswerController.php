<?php

namespace App\Http\Controllers\Api;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\AnswerResource;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class AnswerController extends ApiController
{
    public function __construct()
    {
        $this->resource = AnswerResource::class;
        $this->model = app(Answer::class);
        $this->repositry =  new Repository($this->model);
    }



     public function encodings(){


        $data=[[-0.13760123, 0.03256469, -0.01728623, -0.07947056, -0.07558814, -0.0245158, 0.0619771, -0.11621208, 0.10722999, -0.04936444, 0.25296569, -0.00477981, -0.28533125, -0.04023005, 0.00531576,
0.14520678, -0.15124424, -0.123299, -0.03338526, -0.07403327, 0.07386799, -0.00747267, -0.06063134, 0.09004978, -0.09508941, -0.19491105, -0.10479356, -0.03640846, 0.04161191, -0.11469118, 0.08531182, -0.00626666, -0.15346158, -0.05024426, 0.04019516, 0.05639875, -0.05296013, -0.10330567, 0.18046151, 0.00061227, -0.13286693, -0.06935653, 0.05871885, 0.31483778, 0.10160856, 0.04447101, 0.02201919, -0.07595459, 0.05626147, -0.24972826, 0.08290686, 0.08630288, 0.11900105, 0.10342929, -0.01979758, -0.19395557, 0.07367371, 0.23185432, -0.2172536, 0.14200069, 0.12198755, -0.10775276, 0.0595049, -0.03669466, 0.21371157, 0.04117197, -0.17644799, -0.06991636, 0.07406455, -0.14025266, -0.08265708, 0.04225588, -0.10859381, -0.25451073, -0.30080193, 0.08302838,
0.36894935, 0.20981947, -0.18847318, -0.0804522, -0.02140716, 0.05724635, 0.17914161, 0.08663392, -0.03248443, -0.09489913, -0.14472038, -0.01719314, 0.19878748, 0.02130701, -0.06602672, 0.23124796, 0.00670658, -0.03781209, -0.00042772, 0.1247825, -0.07129457, 0.01160347, -0.04350219, -0.0057048, -0.02346351, -0.09435821, 0.04215334, 0.14260629, -0.14207958, 0.19618362, 0.00409723, 0.01814109, -0.06046817, -0.00975135, -0.0853538, -0.02638637, 0.11224757, -0.24165909, 0.19129197, 0.24266075, 0.04312982, 0.15567005, 0.03202804, 0.09678125, -0.02041968, -0.06664197, -0.13463713, -0.03361819, 0.04252212, -0.02034467, 0.13406612, 0.01332765], [0.02314354, 0.03680617, 0.04761348, -0.01776231, -0.14203791, 0.02315507, -0.03886698, -0.14798577, 0.13819863,
-0.07565539, 0.31974339, -0.08072002, -0.20594195, -0.06174619, 0.0425572, 0.08474275, -0.15899765, -0.09610672, -0.03062975, -0.10176219, 0.13858919, 0.08548466, 0.01374511, -0.02016644, -0.09595428, -0.32429513, -0.08438666, -0.1187892, 0.18464939, -0.07552171, 0.0461361, 0.07995463, -0.17033125, -0.05343266, 0.02301293, -0.01847693, -0.12570621, -0.08727096, 0.1878248, -0.02878248, -0.18772687, -0.03179387, 0.02698771, 0.17499726, 0.12481993, 0.02234117, 0.05038776, -0.07465424, 0.05605368, -0.25044042, 0.05148486, 0.18875226, 0.10974905, 0.01710001, 0.11337536, -0.1336423, -0.02384843, 0.16163041, -0.17042169, 0.14878547, 0.12805875, -0.0774435, -0.00117549, -0.06271486, 0.1888058, 0.05666001, -0.04892608, -0.13819656, 0.12644058, -0.08951914, -0.14217392, 0.14628071, -0.15770303, -0.17714195, -0.27993062, -0.0306299, 0.49701715, 0.02377058, -0.14285746, 0.03673555, -0.03131513, 0.01023457, 0.14985476, 0.03400647, -0.01667406, -0.10253461, -0.1297763, 0.01497636, 0.18434286, -0.09748791, -0.03694025, 0.22552659, -0.05006481, 0.05344104, 0.02282587, 0.04580344, -0.04247278, -0.02679868, -0.05840336, -0.07625212, 0.02310587, -0.06246387, -0.00862123, 0.1301925, -0.14204746, 0.1374038, -0.0153726, 0.03026982, 0.04477279, -0.04915532, -0.0479968, 0.00196492, 0.15920521, -0.26317665, 0.1590811, 0.13186005, 0.02507459, 0.1131251, 0.01284765, 0.05662929, -0.04094047, -0.08541017, -0.2581116, -0.05192762, -0.00687388, -0.0156533, -0.0664106, -0.00110274], [-0.14111093, 0.10096519, 0.04121268, -0.05480931, -0.09585048, -0.05446657, 0.04435004, -0.05770539, 0.23866823, -0.09375604, 0.21782832, -0.02858975, -0.21862261, 0.00203848, -0.04271403, 0.10161657, -0.03466704, -0.16581161, -0.08885039, -0.1243954, 0.01233838, 0.00830991, -0.03148671, 0.10505296, -0.14883161, -0.27202034, -0.05314379, -0.07737777, 0.07672377, -0.12718529, -0.03686379, 0.10997531, -0.13038234, -0.06963997, -0.00567771, 0.08321648, 0.04186824, -0.03512231, 0.25754079, 0.05903339, -0.12557663, 0.04080276, 0.06891938, 0.3980884, 0.17999731, -0.01094013, 0.0432633, -0.01449245, 0.15649804, -0.19109419, 0.09327323, 0.11065363, 0.12245142, 0.00455841, 0.12863249, -0.13808349, -0.07720613, 0.14808977, -0.25955817, 0.16072085, 0.11569734, 0.00705473, -0.09621035, -0.13445428, 0.19655026, 0.17150111, -0.11503007, -0.11698757, 0.18632302, -0.1775343, -0.01083839, 0.0470535, -0.13350663, -0.11643948, -0.14172378, 0.11196294, 0.38955224, 0.1803655, -0.13632736, 0.03664086, -0.00543098, -0.07901092, 0.07373679, 0.00073786, -0.06727403, -0.0391791, -0.06490895, 0.05849525, 0.19185184, 0.11445208, -0.02956298, 0.1761872, 0.00197081, -0.07976972, -0.0051114, 0.02686515, -0.18974893, 0.00739107, -0.16601069, -0.02098677, -0.04289744, -0.09924647, 0.04163064, 0.04443668, -0.13401288, 0.1215779, -0.01411173, 0.0234546, -0.07551458, 0.10595632, -0.12966898, -0.00169212, 0.12731615, -0.20011678, 0.16360714, 0.0453817, 0.03275625, 0.08401223, 0.04685316, 0.05253112, 0.09828447, 0.04258672, -0.07281882, -0.09755338, 0.02114973, -0.06519408,
0.14405254, 0.06652251]];

        // $repeatedData = array_fill(0, 100, $data);
        // $flattenedData = array_merge(...$repeatedData);



        return $this->returnSuccessMessage($data);



       }

    public function save( Request $request ){
        return $this->store( $request->all() );
    }

    public function edit($id,Request $request){


        return $this->update($id,$request->all());

    }
}
