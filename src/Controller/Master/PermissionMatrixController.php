<?php

namespace App\Controller\Master;

use App\Entity\Master\Role;
use App\Entity\Master\Resource;
use App\Entity\Master\PermissionType;
use App\Entity\Master\PermissionMatrix;
use JMS\Serializer\SerializationContext;
use App\Entity\Master\ResourcePermission;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class PermissionMatrixController
 * @package App\Controller\Master
 */
class PermissionMatrixController extends AbstractController
{
    /**
     * @Route("/user/permissionmatrix", name="permissionmatrix_page", options={"expose"= true})
     *
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function list(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $permissionMatrix = new PermissionMatrix();
        $roles = $this->getDoctrine()->getRepository(Role::class)->findAll();
        $resources = $this->getDoctrine()->getRepository(Resource::class)->fetchOrderByResources();
        $permissionTypes = $this->getDoctrine()->getRepository(PermissionType::class)->findAll();
        $resultArr = $this->getDoctrine()->getRepository(ResourcePermission::class)->constructArray($resources);

        if ($request->isXmlHttpRequest()) {
            $checked = $request->request->get('checked');
            $roleId = $request->request->get('roleId');
            $checkboxVal = $request->request->get('checkboxVal');

            $words = explode('-', $checkboxVal);
            $permissionType = $words[0];
            $resourceId = $words[1];

            $permissionTypeObj = $this->getDoctrine()->getRepository(PermissionType::class)
                                                     ->findOneBy(['name' => $permissionType]);
            $permissionTypeId = $permissionTypeObj->getId();

            $resourcePermissionObj = $this->getDoctrine()
                                     ->getRepository(ResourcePermission::class)
                                     ->findOneBy(['resource' => $resourceId, 'permissionType' => $permissionTypeId]);

            $roleObj = $this->getDoctrine()->getRepository(Role::class)->find($roleId);

            if ($checked == 'true') {
                $permissionMatrix->setRole($roleObj);
                $permissionMatrix->setGranted(true);
                $permissionMatrix->setResourcePermission($resourcePermissionObj);
                $em->persist($permissionMatrix);
            } elseif ($checked == 'false') {
                $permissionMatrixObj = $this->getDoctrine()->getRepository(PermissionMatrix::class)
                                       ->findOneBy(
                                           [
                                               'role' => $roleId,
                                               'resourcePermission' => $resourcePermissionObj->getId()
                                           ]
                                       );

//                $permissionMatrixObj->setGranted(false);
                $em->remove($permissionMatrixObj);
            }
            $em->flush();

            return new JsonResponse(['status' => 'success']);
        }


        return $this->render(
            'master/permissionMatrix/add.html.twig',
            [
                'entity' => $permissionMatrix,
                'roles' => $roles,
                'resArr' => $resultArr,
                'resources' => $resources,
                'permissionTypes' => $permissionTypes,
                'entityName' => 'PermissionMatrix',
            ]
        );
    }

    /**
     * @Route("/fetch-permissionmatrix", name="fetch_permissionmatrix_page", options={"expose"= true})
     */
    public function fetchPermissionMatrix(Request $request, SerializerInterface $serializer)
    {
        if ($request->isXmlHttpRequest()) {
            $roleVal = $request->request->get('roleVal');
            $roleObj = $this->getDoctrine()->getRepository(Role::class)->findOneBy(['name' => $roleVal]);
            if ($roleObj) {
                $roleId = $roleObj->getId();
                $resourcePermissionRes = $this->getDoctrine()
                    ->getRepository(PermissionMatrix::class)
                    ->findByRolePermissionMatrix($roleId);
                $context = new SerializationContext();
                $context->setSerializeNull(true);
                $output = $serializer->serialize($resourcePermissionRes, 'json', $context);
                return $json = new Response($output);
            }
            return new JsonResponse(['status' => 'No roles are selected']);
        }
    }
}
