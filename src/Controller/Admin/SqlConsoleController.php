<?php

namespace App\Controller\Admin;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class SqlConsoleController extends AbstractController
{
    #[Route('/admin/sql-console', name: 'admin_sql_console')]
    public function index(Request $request, Connection $connection): Response
    {
        $result = null;
        $error = null;
        $executedSql = null;

        if ($request->isMethod('POST')) {
            $quickSelect = $request->request->get('quick_select');

            if ($quickSelect === 'form_submission') {
                $sql = 'SELECT * FROM form_submission';
            } else {
                $sql = $request->request->get('sql_command');
            }

            $executedSql = $sql;

            try {
                if (stripos($sql, 'SELECT') === 0) {
                    $stmt = $connection->prepare($sql);
                    $result = $stmt->executeQuery()->fetchAllAssociative();
                } else {
                    $affectedRows = $connection->executeStatement($sql);
                    $result = ['affected_rows' => $affectedRows];
                }
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        }

        return $this->render('admin/sql_console/index.html.twig', [
            'result' => $result,
            'error' => $error,
            'executedSql' => $executedSql,
        ]);
    }
}
