-- cuser_incentive data massage - works
-- UPDATE cuser_incentive SET created_at = to_timestamp(created_at_raw, 'DD-MON-YY HH.MI.SS.US000 AM');
-- SELECT * FROM cuser_incentive;
-- ALTER TABLE cuser_incentive DROP COLUMN created_at_raw;

--rider history data massage - works
-- SELECT *
-- FROM rider_history;
--
--                          updated_at = to_timestamp(updated_at_raw, 'DD-MON-YY HH.MI.SS.US000 AM');
-- UPDATE rider_history SET created_at = to_timestamp(created_at_raw, 'DD-MON-YY HH.MI.SS.US000 AM'),
-- ALTER TABLE rider_history DROP COLUMN created_at_raw;
-- ALTER TABLE rider_history DROP COLUMN updated_at_raw;
-- ALTER TABLE rider_history DROP COLUMN time_of_request_raw;

--tbl_incentive data massage
-- ALTER TABLE tbl_incentive DROP COLUMN created_at_raw;
-- ALTER TABLE tbl_incentive DROP COLUMN updated_at_raw;

--tbl tripreceipt data massage
SELECT *
FROM tbl_tripreceipt;
-- UPDATE tbl_tripreceipt SET created_at =  to_timestamp(created_at_raw, 'DD-MON-YY HH.MI.SS.US000 AM')
-- WHERE created_at IS NULL AND created_at_raw is NOT NULL ;
-- TRUNCATE TABLE tbl_tripreceipt CASCADE ;
-- ALTER TABLE tbl_tripreceipt DISABLE TRIGGER ALL;
-- ALTER TABLE tbl_tripreceipt ENABLE TRIGGER ALL;
-- UPDATE tbl_tripreceipt SET updated_at =  to_timestamp(updated_at_raw, 'DD-MON-YY HH.MI.SS.US000 AM')
-- WHERE updated_at_raw is NOT NULL;
-- UPDATE tbl_tripreceipt SET start_datetime =  to_timestamp(start_datetime_raw, 'DD-MON-YY HH.MI.SS.US000 AM')
-- WHERE start_datetime is  NULL;
-- UPDATE tbl_tripreceipt SET end_datetime =  to_timestamp(end_datetime_raw, 'DD-MON-YY HH.MI.SS.US000 AM')
-- WHERE end_datetime is  NULL;
-- ALTER TABLE tbl_tripreceipt DROP COLUMN created_at_raw;
-- ALTER TABLE tbl_tripreceipt DROP COLUMN updated_at_raw;
-- ALTER TABLE tbl_tripreceipt DROP COLUMN start_datetime_raw;
-- ALTER TABLE tbl_tripreceipt DROP COLUMN end_datetime_raw;

--tripreceip incen data massage
SELECT *
FROM tbl_tripreceipt_incentive;
-- ALTER TABLE tbl_tripreceipt_incentive DISABLE TRIGGER ALL ;
-- UPDATE tbl_tripreceipt_incentive SET created_at=to_timestamp(created_at_raw,'DD-MON-YY HH.MI.SS.US000 AM')
-- WHERE created_at_raw IS NOT NULL ;
-- UPDATE tbl_tripreceipt_incentive SET updated_at=to_timestamp(updated_at_raw,'DD-MON-YY HH.MI.SS.US000 AM')
-- WHERE updated_at_raw IS NOT NULL ;
-- UPDATE tbl_tripreceipt_incentive SET qualifying_datetime=to_timestamp(qualifying_datetime_raw,'DD-MON-YY HH.MI.SS.US000 AM')
-- WHERE qualifying_datetime_raw IS NOT NULL ;
-- ALTER TABLE tbl_tripreceipt_incentive DROP COLUMN created_at_raw;
-- ALTER TABLE tbl_tripreceipt_incentive DROP COLUMN updated_at_raw;
-- ALTER TABLE tbl_tripreceipt_incentive DROP COLUMN qualifying_datetime_raw;
-- ALTER TABLE tbl_tripreceipt_incentive DROP COLUMN disbursement_date_raw;

-- ALTER TABLE tbl_tripreceipt_incentive ENABLE TRIGGER ALL ;

--trip receipt point data massage
SELECT * FROM tripreceipt_point;
-- ALTER TABLE tripreceipt_point DISABLE TRIGGER ALL ;
-- UPDATE tripreceipt_point SET created_at=to_timestamp(created_at_raw,'DD-MON-YY HH.MI.SS.US000 AM') WHERE created_at_raw IS NOT NULL ;
-- ALTER TABLE tripreceipt_point DROP COLUMN created_at_raw;
-- ALTER TABLE tripreceipt_point ENABLE TRIGGER ALL ;

--vw eligible data massage
SELECT * FROM vw_eligibletrips;
-- UPDATE vw_eligibletrips SET created_at = to_timestamp(created_at_raw, 'DD-MON-YY HH.MI.SS.US000 AM');
-- ALTER TABLE vw_eligibletrips DROP COLUMN created_at_raw;

SELECT '2017-1-22' > (current_date - INTERVAL '1 year');


-- 11-25
-- DELETE FROM carpoolnowdb.tbl_tripreceipt WHERE id_driver = '57d4343c1af4257d4343c1af47'; --maddog00 driver
-- TRUNCATE TABLE carpoolnowdb.tripreceipt_point;
-- DELETE FROM carpoolnowdb.tbl_tripreceipt WHERE id_trip = '5bfb5bfe8d2d35bfb5bfe8d2d5';

-- UPDATE "carpoolnowdb"."tripreceipt_point" SET "cuser_id" = NULL WHERE "id_trip" = :id_trip;
